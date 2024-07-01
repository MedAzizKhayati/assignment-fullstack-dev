import React, { InputHTMLAttributes } from "react";

const SearchInput = (props: InputHTMLAttributes<HTMLInputElement>) => {
	return (
		<div className="relative w-full max-w-2xl">
			<input
				type="text"
				placeholder="Search"
				{...props}
				className={
					"w-full py-3 pl-10 pr-4 rounded-full shadow-md " +
					"focus:ring-2 focus:ring-gray-200 focus:outline-none " +
					(props.className ? " " + props.className : "")
				}
			/>
			{/* Search Icon */}
			<div className="absolute inset-y-0 left-0 flex items-center pl-3">
				<svg
					className="w-5 h-5 text-gray-600"
					fill="none"
					stroke="currentColor"
					viewBox="0 0 24 24"
					xmlns="http://www.w3.org/2000/svg"
				>
					<path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 15l5.5 5.5" />
					<circle cx="10" cy="10" r="7" />
				</svg>
			</div>
		</div>
	);
};

export default SearchInput;
