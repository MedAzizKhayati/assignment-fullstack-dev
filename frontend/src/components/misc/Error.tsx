import React from "react";

interface ErrorProps {
	errorMessage: string;
}

const Error: React.FC<ErrorProps> = ({ errorMessage }) => {
	return (
		<div className="flex flex-col items-center justify-center">
			<div className="text-6xl text-red-500">😢</div>
			<h1 className="text-2xl font-bold text-gray-600 mt-4">Oops! Something went wrong.</h1>
			<p className="text-sm text-red-600 ">{errorMessage}</p>
		</div>
	);
};

export default Error;
