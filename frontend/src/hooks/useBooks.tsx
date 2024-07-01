import { useQuery } from "@tanstack/react-query";
import { BookService } from "../services/book.service";
import useDebounce from "./useDebounce";
import { useState } from "react";

const useBooks = (search?: string) => {
	const debouncedSearch = useDebounce(search, 500);
	const [limit, setLimit] = useState(5);
	const [offset, setOffset] = useState(0);

	const query = useQuery({
		queryKey: ["books", debouncedSearch, limit, offset],
		queryFn: () =>
			BookService.getBooks({
				keyword: debouncedSearch || undefined,
				limit,
				offset,
			}),
	});

	return {
		...query,
		setLimit,
		setOffset,
	};
};

export default useBooks;
