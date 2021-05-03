function previewImg(
	id,
	classLabel = ".custom-file-label",
	classPreview = ".img-preview"
) {
	if (id == "undefined" || id == "") {
		return false;
	}

	const sampul = document.querySelector(id);
	const sampulLabel = document.querySelector(classLabel);
	const imgPreview = document.querySelector(classPreview);

	sampulLabel.textContent = sampul.files[0].name;

	const fileSampul = new FileReader();
	fileSampul.readAsDataURL(sampul.files[0]);

	fileSampul.onload = function (e) {
		imgPreview.src = e.target.result;
	};
}
