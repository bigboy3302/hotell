function changeMonth(monthOffset, currentDate) {
  // Get current month and year
  var currentMonth = currentDate.getMonth();
  var currentYear = currentDate.getFullYear();

  // Calculate new month and year
  var newMonth = currentMonth + monthOffset;
  var newYear = currentYear;
  if (newMonth < 0) {
    newMonth = 11; // December
    newYear--;
  } else if (newMonth > 11) {
    newMonth = 0; // January
    newYear++;
  }

  // Redirect to the new month
  window.location.href =
    "/calendar?year=" + newYear + "&month=" + (newMonth + 1);
}
