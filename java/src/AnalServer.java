import com.sun.net.httpserver.HttpExchange;
import com.sun.net.httpserver.HttpHandler;
import com.sun.net.httpserver.HttpServer;

import java.io.IOException;
import java.io.OutputStream;
import java.net.InetSocketAddress;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.List;
import java.util.regex.Pattern;
import java.util.regex.Matcher;
import java.util.stream.Stream;
import java.util.stream.Collectors;
import java.util.Stack;
import java.util.ArrayList;
import java.util.Collections;
import java.io.ByteArrayOutputStream;

public class AnalServer {
    public static void main(String[] args) throws IOException {
        HttpServer server = HttpServer.create(new InetSocketAddress(8001), 0);

        Pattern emptyLinePattern = Pattern.compile("\\s*(#.*)?");
        Pattern functionPattern = Pattern.compile("\\s*def\\s+.*?\\(.*");

        server.createContext("/lineCount", new LineStreamHttpHandler(lineStream -> {
            long count = lineStream
                .filter(line -> !emptyLinePattern.matcher(line).matches())
                .count();
            return "{\"lineCount\":" + count + "}";
        }));

        server.createContext("/functionCount", new LineStreamHttpHandler(lineStream -> {
            long count = lineStream
                .filter(line -> functionPattern.matcher(line).matches())
                .count();
            return "{\"functionCount\":" + count + "}";
        }));

        server.createContext("/functionAnal", new LineStreamHttpHandler(lineStream -> {
            Stream<String> codeLines = lineStream
                .filter(line -> !emptyLinePattern.matcher(line).matches());
            Stack<IndentCount> functions = new Stack<>();
            List<Integer> functionsLineCount = new ArrayList<>();
            int i = 1;

            for (String line : (Iterable<String>)codeLines::iterator) {
                int indent = (int)line.chars().takeWhile(c -> c == ' ').count();

                if (!functions.empty() && indent <= functions.peek().indent)
                    functionsLineCount.add(i - functions.pop().count);
                
                if (line.startsWith("def ", indent))
                    functions.push(new IndentCount(indent, i));

                i++;
            }
            functionsLineCount.add(i - functions.pop().count);

            return "{\"functionCount\":" + functionsLineCount.size()
                + ",\"functionMin\":" + Collections.min(functionsLineCount)
                + ",\"functionAvg\":" + functionsLineCount.stream().mapToDouble(x -> x).sum()
                                      / functionsLineCount.size()
                + ",\"functionMax\":" + Collections.max(functionsLineCount)
                + "}";
        }));

        server.createContext("/grep", new GrepHttpHandler());

        server.setExecutor(null); // Use the default executor
        server.start();

        System.out.println("Server started on port 8001");
    }

    private static class GrepHttpHandler extends JsonHttpHandler {
        @Override
        protected String handleJson(HttpExchange exchange) throws Exception {
            ByteArrayOutputStream baos = new ByteArrayOutputStream();
            exchange.getRequestBody().transferTo(baos);
            String contents = baos.toString("UTF-8");

            String re = exchange.getRequestURI().getQuery();

            Pattern pattern = Pattern.compile(re);
            Matcher matcher = pattern.matcher(contents);

            long count = 0;
            while (matcher.find())
                count++;

            return "{\"hits\":" + count + "}";
        }
    }

    private static record IndentCount(int indent, int count) {}
}
