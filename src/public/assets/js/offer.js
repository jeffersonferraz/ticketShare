
// GET TIME 
const now = new Date();
now.setUTCHours(now.getUTCHours() + 1);
const formatted = now.toISOString().slice(0, 16);
document.getElementById("datetime").value = formatted;