document.addEventListener("DOMContentLoaded", function () {
  var e = document.getElementById("calendar");
  new FullCalendar.Calendar(e, {
    headerToolbar: {
      left: "prev,next today",
      center: "title",
      right: "dayGridMonth,timeGridWeek,timeGridDay",
    },
    defaultDate: "2024-06-12",
    timeZone: "UTC",
    initialView: "dayGridMonth",
    editable: !0,
    selectable: !0,
    events: [
      {
        title: "Business Lunch",
        start: "2024-06-03T13:00:00",
        constraint: "businessHours",
      },
      {
        title: "Meeting",
        start: "2024-06-13T11:00:00",
        constraint: "availableForMeeting",
      },
      { title: "Conference", start: "2024-06-27", end: "2024-06-29" },
      { title: "Conference", start: "2024-03-27", end: "2024-02-29" },
      {
        groupId: "availableForMeeting",
        start: "2024-06-11T10:00:00",
        end: "2024-06-11T16:00:00",
        title: "Repeating Event",
      },
      {
        groupId: "availableForMeeting",
        start: "2024-06-15T10:00:00",
        end: "2024-06-15T16:00:00",
        title: "holiday",
        className: "bg-danger-subtle text-danger",
      },
      {
        groupId: "availableForMeeting",
        start: "2024-02-15T10:00:00",
        end: "2024-02-15T16:00:00",
        title: "holiday",
        className: "bg-danger-subtle text-danger",
      },
      {
        start: "2024-06-06",
        end: "2024-06-08",
        overlap: !1,
        title: "New Event",
      },
    ],
  }).render();
});
