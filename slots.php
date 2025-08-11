<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Slot Availability</title>
      <style>
             body {
                 font-family: Arial, sans-serif;
                 padding: 20px;
                 background: #f5f5f5;
                 margin: 0;
             }
             h2 {
                 text-align: center;
                 margin-bottom: 10px;
             }
             .filter-container {
                 display: flex;
                 justify-content: center;
                 margin-bottom: 20px;
                 flex-wrap: wrap;
                 gap: 10px;
             }
             input[type="date"] {
                 padding: 8px;
                 font-size: 16px;
             }
             .slots-grid {
                 display: grid;
                 grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
                 gap: 10px;
             }
             .slot {
                 padding: 15px;
                 text-align: center;
                 border-radius: 8px;
                 color: white;
                 font-weight: bold;
                 cursor: pointer;
             }
             .available {
                 background-color: #4CAF50;
             }
             .booked {
                 background-color: #E74C3C;
                 cursor: not-allowed;
             }
             .slot:hover.available {
                 background-color: #45a049;
             }
             @media (max-width: 600px) {
                 .slot {
                     padding: 10px;
                     font-size: 14px;
                 }
             }
			 .back-link {
    text-decoration: none; /* Remove default underline */
    color: #333; /* Set link color */
    font-size: 1.1em; /* Adjust font size */
    position: relative; /* Enable positioning of the arrow */
    padding-left: 20px; /* Add space for the arrow */
}

.back-link::before {
    content: "\2190"; /* Unicode left arrow character */
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    font-size: 1.2em; /* Adjust arrow size */
    margin-right: 5px; /* Space between arrow and text */
}

.back-link:hover {
    color: #007bff; /* Change color on hover */
}
      </style>
   </head>
   <body>
      <h2>Check Slot Availability</h2>
	  <a href="#" class="back-link"></a>
      <div class="filter-container">
             <input type="date" id="dateFilter">
      </div>

      <div class="slots-grid" id="slotsContainer">
             <!-- Slots will appear here -->
      </div>
      <script>
             const slotsContainer = document.getElementById("slotsContainer");
             const dateFilter = document.getElementById("dateFilter");
         
             // Sample booked data
             const bookedSlots = {
                 "2025-08-11": ["09:00", "13:00", "18:00"],
                 "2025-08-12": ["10:00", "14:00", "16:00"]
             };
         
             // Generate hourly slots
             function generateSlots(selectedDate) {
                 slotsContainer.innerHTML = "";
                 for (let hour = 8; hour <= 20; hour++) {
                     const time = `${hour.toString().padStart(2, "0")}:00`;
                     const slotDiv = document.createElement("div");
                     slotDiv.classList.add("slot");
         
                     if (bookedSlots[selectedDate]?.includes(time)) {
                         slotDiv.classList.add("booked");
                         slotDiv.textContent = `${time} - Booked`;
                     } else {
                         slotDiv.classList.add("available");
                         slotDiv.textContent = `${time} - Available`;
                         slotDiv.addEventListener("click", () => {
                             alert(`You selected ${time} on ${selectedDate}`);
                         });
                     }
         
                     slotsContainer.appendChild(slotDiv);
                 }
             }
         
             // Load today's slots by default
             const today = new Date().toISOString().split("T")[0];
             dateFilter.value = today;
             generateSlots(today);
         
             // Change slots on date change
             dateFilter.addEventListener("change", () => {
                 generateSlots(dateFilter.value);
             });
      </script>
   </body>
</html>
