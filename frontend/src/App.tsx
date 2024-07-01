import { QueryClient, QueryClientProvider } from "@tanstack/react-query";
import BookList from "./components/book/BookList";

const queryClient = new QueryClient();

export function App() {
	return (
		<QueryClientProvider client={queryClient}>
			<div className="max-w-screen-lg mx-auto p-4">
				<h3 className="text-center font-medium text-sm text-gray-500 mt-7">
					Search or check the books below
				</h3>
				<h1 className="text-center font-bold text-2xl sm:text-3xl text-gray-600">
					Search for your favorite books
				</h1>
				<BookList />
			</div>
		</QueryClientProvider>
	);
}
