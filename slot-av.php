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
        text-decoration: none;
        /* Remove default underline */
        color: #333;
        /* Set link color */
        font-size: 1.1em;
        /* Adjust font size */
        position: relative;
        /* Enable positioning of the arrow */
        padding-left: 20px;
        /* Add space for the arrow */
    }

    .back-link::before {
        content: "\2190";
        /* Unicode left arrow character */
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.2em;
        /* Adjust arrow size */
        margin-right: 5px;
        /* Space between arrow and text */
    }

    .back-link:hover {
        color: #007bff;
        /* Change color on hover */
    }
    </style>
</head>

<body>
    <?php include 'header.php' ?>
    <h2>Slot Availability</h2>

    <div class="filter-container">
        <input type="date" id="dateFilter">
    </div>

    <div class="slots-grid" id="slotsContainer"></div>
    <br>
    <div id="av" style="margin: 0 auto;"></div>
    <?php include 'footer.php' ?>
    <script>
    const slotsContainer = document.getElementById("slotsContainer");
    const avslot = document.getElementById("av");
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
        avslot.innerHTML = "";
        if (bookedSlots.length > 0) {
            for (let i = 0; i < bookedSlots.length; i++) {
                const slotDiv = document.createElement("div");
                slotDiv.classList.add("slot");
                slotDiv.classList.add("booked");
                slotDiv.textContent = bookedSlots[i];
                slotsContainer.appendChild(slotDiv);
            }
        } else {
            slotsContainer.innerHTML =
                "<div style='text-align: center;background: coral;'> All Slots Available</div>";
        }
        let newDiv = document.createElement("div");
        newDiv.innerHTML = '<a href="create.php"><div class="slot available">Book Slot</div></a>';
        avslot.append(newDiv);
    }
    </script>

</body>

</html>