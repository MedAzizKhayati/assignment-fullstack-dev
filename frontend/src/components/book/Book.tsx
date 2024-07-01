import { cn } from "../../lib/utils";
import { Book as BookType } from "../../services/book.service";

const Book: React.FC<{ book: BookType }> = ({ book }) => {
	return (
		<div
			className={cn(
				"border-b border-gray-200 p-4 flex flex-col gap-3 transition",
				"hover:shadow-lg rounded-lg hover:bg-gray-200 hover:scale-[1.01]"
			)}
		>
			<h2 className="text-xl font-semibold text-gray-600">{book.title}</h2>
			<div className="flex justify-between mt-auto">
				<span className="text-xs text-gray-500 italic">
					{book.authors.map((a) => a.name).join(", ")} {/* John Doe, Jane Doe */}
				</span>
				<span className="text-xs text-gray-400">{new Date(book.publishedAt).toLocaleString()}</span>
			</div>
		</div>
	);
};

export default Book;
