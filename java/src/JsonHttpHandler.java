import com.sun.net.httpserver.HttpExchange;
import com.sun.net.httpserver.HttpHandler;

import java.io.IOException;
import java.io.OutputStream;
import java.io.PrintWriter;
import java.io.StringWriter;

abstract class JsonHttpHandler implements HttpHandler {
    @Override
    public void handle(HttpExchange exchange) throws IOException {
        String response;
        int statusCode;

        if (exchange.getRequestMethod().equals("POST")) {
            try {
                response = handleJson(exchange);
                exchange.getResponseHeaders().set("Content-Type", "application/json");
                statusCode = 200;
            } catch (Exception e) {
                StringWriter sw = new StringWriter();
                PrintWriter pw = new PrintWriter(sw);
                e.printStackTrace(pw);
                response = sw.toString();
                statusCode = 500;
            }
        } else {
            statusCode = 405;
            response = "Method Not Allowed";
        }

        exchange.sendResponseHeaders(statusCode, response.length());

        OutputStream os = exchange.getResponseBody();
        os.write(response.getBytes());
        os.close();
    }

    protected abstract String handleJson(HttpExchange exchange) throws Exception;
}
