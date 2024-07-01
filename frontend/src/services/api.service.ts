import axios, { AxiosInstance } from "axios";

export type PaginationOptions = {
	offset?: number;
	limit?: number;
};
export type Page<T> = {
	content: T[];
	totalElements: number;
	offset: number;
	limit: number;
};

const api: AxiosInstance = axios.create({
	baseURL: process.env.VITE_APP_BASE_URL || "http://localhost:8000",
});

api.interceptors.response.use(
	(response) => response.data,
	(error) => {
		throw error;
	}
);

export default api;
