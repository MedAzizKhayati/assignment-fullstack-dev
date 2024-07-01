import api, { Page, PaginationOptions } from "./api.service";

export type Author = {
	id: string;
	name: string;
};
export type Book = {
	id: string;
	title: string;
	publishedAt: string;
	authors: Author[];
};

export class BookService {
	static async getBooks({
		offset,
		limit,
		keyword,
	}: PaginationOptions & {
		keyword?: string;
	} = {}): Promise<Page<Book>> {
		const url = new URLSearchParams();

		if (offset) url.append("offset", offset.toString());
		if (limit) url.append("limit", limit.toString());
		if (keyword) url.append("keyword", keyword);

		return await api.get(`/books?${url.toString()}`);
	}

	static async getBook(id: string) {
		return await api.get(`/books/${id}`);
	}
}
