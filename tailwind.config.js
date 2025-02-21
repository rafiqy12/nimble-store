/** @type {import('tailwindcss').Config} */
module.exports = {
	content: ["./application/**/*.{php,html,js}", "./public/**/*.{php,html,js}", "./node_modules/preline/dist/*.js"],
	safelist: ["object-cover"],
	theme: {
		extend: {
			container: {
				center: true,
				"2xl": "1320px",
			},
			fontFamily: {
				"open-sans": ["Open-Sans", "sans-serif"],
				rubik: ["Rubik", "sans-serif"],
				body: [
					"Open Sans",
					"ui-sans-serif",
					"system-ui",
					"-apple-system",
					"system-ui",
					"Segoe UI",
					"Roboto",
					"Helvetica Neue",
					"Arial",
					"Noto Sans",
					"sans-serif",
					"Apple Color Emoji",
					"Segoe UI Emoji",
					"Segoe UI Symbol",
					"Noto Color Emoji",
				],
				sans: [
					"Open Sans",
					"ui-sans-serif",
					"system-ui",
					"-apple-system",
					"system-ui",
					"Segoe UI",
					"Roboto",
					"Helvetica Neue",
					"Arial",
					"Noto Sans",
					"sans-serif",
					"Apple Color Emoji",
					"Segoe UI Emoji",
					"Segoe UI Symbol",
					"Noto Color Emoji",
				],
			},
			colors: {
				"light-gray": "#E7E7E3",
				"off-white": "#FAFAFA",
				"dark-charcoal": "#232321",
				"royal-blue": "#4A69E2",
				"golden-orange": "#FFA52F",
				primary: {
					50: "#eff6ff",
					100: "#dbeafe",
					200: "#bfdbfe",
					300: "#93c5fd",
					400: "#60a5fa",
					500: "#3b82f6",
					600: "#2563eb",
					700: "#1d4ed8",
					800: "#1e40af",
					900: "#1e3a8a",
					950: "#172554",
				},
				"blue-01": "#4A69E2",
				"black-01": "#232321",
				"yellow-01": "#eab308",
				"green-01": "#FFA52F",
				"gray-01": "#C9CCC6",
			},
			screens: {
				"2xl": "1320px",
			},
		},
	},
	plugins: [require("@tailwindcss/forms"), require("preline/plugin")],
};
