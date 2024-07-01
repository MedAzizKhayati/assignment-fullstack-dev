import React from "react";
import Book from "./Book";
import useBooks from "../../hooks/useBooks";
import SearchInput from "../misc/SearchInput";
import Loader from "../misc/Loader";
import Error from "../misc/Error";
import NoBooksFound from "./NoBooksFound";
import Paginate from "../misc/Paginate";

const BookList: React.FC = () => {
	const [search, setSearch] = React.useState("");
	const { data: books, isLoading, isError, error, setLimit, setOffset } = useBooks(search);

	return (
		<div className="flex flex-col items-center mt-3 gap-6">
			<SearchInput
				value={search}
				onChange={(e) => {
					setSearch(e.target.value);
					setOffset(0);
				}}
			/>
			{/********************ERROR********************/}
			{isError && <Error errorMessage={error.message} />}
			{/*******************LOADER********************/}
			{isLoading && <Loader />}
			{/*******************NO BOOKS FOUND********************/}
			{books?.content.length === 0 && <NoBooksFound />}
			{/*******************BOOKS********************/}
			{books && books?.content.length > 0 && (
				<>
					<h4 className="text-sm mr-auto ml-4 -mb-5 mt-6 text-gray-400">
						{books.offset + 1} - {books.offset + books.content.length} of{" "}
						{books.totalElements} books
					</h4>
					<Paginate
						data={books.content}
						renderElement={(book) => <Book book={book} />}
						getKey={(book) => book.id}
						totalElements={books.totalElements}
						offset={books.offset}
						limit={books.limit}
						setLimit={setLimit}
						setOffset={setOffset}
					/>
				</>
			)}
		</div>
	);
};

export default BookList;
