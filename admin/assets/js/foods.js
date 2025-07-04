function toggleForm() {
  const form = document.getElementById("formAddFood");
  if (form.style.display === "none") {
    form.style.display = "block";
    form.scrollIntoView({ behavior: "smooth" });
  } else {
    form.style.display = "none";
  }
}
