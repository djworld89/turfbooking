<?php
// index.php
?>
<!DOCTYPE html>
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
    h2 { text-align: center; margin-bottom: 20px; }
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
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
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
    .available { background-color: #4CAF50; }
    .booked { background-color: #E74C3C; cursor: not-allowed; }
    .slot:hover.available { background-color: #45a049; }
    @media (max-width: 600px) {
        .slot { padding: 10px; font-size: 14px; }
    }
</style>
</head>
<body>

<h2>Check Slot Availability</h2>

<div class="filter-container">
    <label for="dateFilter">Select Date:</label>
    <input type="date" id="dateFilter">
</div>

<div class="slots-grid" id="slotsContainer"></div>

<script>
    const slotsContainer = document.getElementById("slotsContainer");
    const dateFilter = document.getElementById("dateFilter");

    // Load today's date
    const today = new Date().toISOString().split("T")[0];
    dateFilter.value = today;
    fetchSlots(today);

    dateFilter.addEventListener("change", () => {
        fetchSlots(dateFilter.value);
    });

    function fetchSlots(selectedDate) {
        fetch(`get_slots.php?date=${selectedDate}`)
            .then(res => res.json())
            .then(bookedSlots => {
                generateSlots(selectedDate, bookedSlots);
            })
            .catch(err => console.error(err));
    }

    function generateSlots(selectedDate, bookedSlots) {
        slotsContainer.innerHTML = "";
        for (let hour = 8; hour <= 20; hour++) {
            const time = `${hour.toString().padStart(2, "0")}:00:00`;
            const slotDiv = document.createElement("div");
            slotDiv.classList.add("slot");

            if (bookedSlots.includes(time)) {
                slotDiv.classList.add("booked");
                slotDiv.textContent = `${time.slice(0,5)} - Booked`;
            } else {
                slotDiv.classList.add("available");
                slotDiv.textContent = `${time.slice(0,5)} - Available`;
                slotDiv.addEventListener("click", () => {
                    alert(`You selected ${time.slice(0,5)} on ${selectedDate}`);
                });
            }

            slotsContainer.appendChild(slotDiv);
        }
    }
</script>

</body>
</html>
