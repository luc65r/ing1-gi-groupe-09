import com.sun.net.httpserver.HttpExchange;

import java.util.function.Function;
import java.util.stream.Stream;
import java.io.InputStreamReader;
import java.io.BufferedReader;

class LineStreamHttpHandler extends JsonHttpHandler {
    private Function<Stream<String>, String> f;

    public LineStreamHttpHandler(Function<Stream<String>, String> f) {
        this.f = f;
    }

    @Override
    protected String handleJson(HttpExchange exchange) throws Exception {
        InputStreamReader isr = new InputStreamReader(exchange.getRequestBody());
        BufferedReader br = new BufferedReader(isr);
        Stream<String> lineStream = br.lines();

        return f.apply(lineStream);
    }
}
