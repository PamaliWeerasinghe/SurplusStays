const select = document.getElementById("timeRangeSelect");
const barChart = document.getElementById("barChartContainer");
const barLabels = document.getElementById("barLabels");

const weekDays = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", 
                "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

select.addEventListener("change", updateChart);

function getLastMonthData() {
    const now = new Date();
    const lastMonth = new Date(now.getFullYear(), now.getMonth() - 1, 1);
    const year = lastMonth.getFullYear();
    const month = lastMonth.getMonth();
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    const data = monthData;

    const labels = Array.from({ length: daysInMonth }, (_, i) => (i + 1).toString());

    return { data, labels };
}

function applyScaling(data) {
    const maxVal = Math.max(...data);
    const minHeight = 10; // Minimum height in %

    return data.map(value => {
        if (maxVal === 0) return 0;
        return Math.max((value / maxVal) * 100, value > 0 ? minHeight : 0);
    });
}

function updateChart() {
    const selected = select.value;

    // Clear previous bars and labels
    barChart.innerHTML = '';
    barLabels.innerHTML = '';

    const dayBlock = document.querySelector(".day-block");

    let rawData = [];
    let labels = [];
    let isNarrow = false;
    let isYear = false;

    if (selected === "This Week") {
        rawData = weekData;
        labels = weekDays;
    } else if (selected === "This Year") {
        rawData = yearData;
        labels = months;
        isYear = true;
    } else if (selected === "Last Month") {
        const result = getLastMonthData();
        rawData = result.data;
        labels = result.labels;
        isNarrow = true;
    }

    const scaledData = applyScaling(rawData);

    // Adjust column gap based on bar type
    if (isNarrow == true) {
        dayBlock.style.columnGap = "1.895%";
    } else if (isYear == true) {
        dayBlock.style.columnGap = "6%";
    } else {
        dayBlock.style.columnGap = "6.5%";
    }

    scaledData.forEach((percent, index) => {
        const bar = document.createElement("div");
        bar.className = "bar";
        bar.style.setProperty("--value", `${percent}%`);
        if (isNarrow) bar.style.width = "15px";
        barChart.appendChild(bar);
    });

    labels.forEach(label => {
        const day = document.createElement("div");
        day.className = "day";
        day.textContent = label;
        barLabels.appendChild(day);
    });

    barChart.style.gridTemplateColumns = `repeat(${rawData.length}, 1fr)`;
}

updateChart();
