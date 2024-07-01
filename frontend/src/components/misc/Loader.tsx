import { twMerge } from "tailwind-merge";

type LoaderProps = {
	className?: string;
};
const Loader = (props: LoaderProps) => {
	return (
		<div
			className={twMerge(
				"animate-spin rounded-full h-10 w-10 border-t-2 border-b-2 border-gray-600",
				props.className
			)}
		/>
	);
};

export default Loader;
