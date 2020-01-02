let request = async (param) => {
	let data = await axios.get(param);
	return data;
}
export default request;

