import React from "react";
import {
	Pagination,
	PaginationContent,
	PaginationItem,
	PaginationNext,
	PaginationPrevious,
} from "../ui/pagination";
import {
	Select,
	SelectContent,
	SelectGroup,
	SelectItem,
	SelectLabel,
	SelectTrigger,
	SelectValue,
} from "../ui/select";
import { cn } from "../../lib/utils";

interface PaginateProps<T> {
	data: T[];
	pageSizeOptions?: number[];
	totalElements: number;
	offset: number;
	limit: number;
	renderElement: (item: T) => React.ReactNode;
	getKey: (item: T) => string;
	setLimit: (limit: number) => void;
	setOffset: (offset: number) => void;
}

const Paginate = <T,>({
	data,
	renderElement,
	getKey,
	pageSizeOptions = [5, 20, 50],
	totalElements,
	offset,
	limit,
	setLimit,
	setOffset,
}: PaginateProps<T>) => {
	const isPrevDisabled = offset === 0;
	const isNextDisabled = offset + limit >= totalElements;

	const handlePageSizeChange = (value: string) => {
		setLimit(parseInt(value));
		setOffset(0);
	};

	const handleNextPage = () => {
		setOffset(offset + limit);
	};

	const handlePrevPage = () => {
		setOffset(offset - limit);
	};

	return (
		<div className="flex flex-col w-full">
			<div className="grid grid-cols-1 gap-1">
				{data.map((item) => (
					<div key={getKey(item)}>{renderElement(item)}</div>
				))}
			</div>
			<div className="flex justify-end mt-4 gap-1">
				<Pagination>
					<PaginationContent>
						<PaginationItem>
							<PaginationPrevious
								className={cn(
									"cursor-pointer",
									isPrevDisabled ? "opacity-50 pointer-events-none" : ""
								)}
								onClick={!isPrevDisabled ? handlePrevPage : undefined}
							/>
						</PaginationItem>
						<PaginationItem>
							{(offset / limit + 1).toFixed(0)} / {Math.ceil(totalElements / limit)}
						</PaginationItem>
						<PaginationItem>
							<PaginationNext
								className={cn(
									"cursor-pointer",
									isNextDisabled ? "opacity-50 pointer-events-none" : ""
								)}
								onClick={!isNextDisabled ? handleNextPage : undefined}
							/>
						</PaginationItem>
					</PaginationContent>
				</Pagination>
				<Select onValueChange={handlePageSizeChange}>
					<SelectTrigger className="w-32">
						<SelectValue placeholder={limit} />
					</SelectTrigger>
					<SelectContent>
						<SelectGroup>
							<SelectLabel>Size</SelectLabel>
							{pageSizeOptions.map((size) => (
								<SelectItem className="cursor-pointer " key={size} value={size.toString()}>
									{size}
								</SelectItem>
							))}
						</SelectGroup>
					</SelectContent>
				</Select>
			</div>
		</div>
	);
};

export default Paginate;
