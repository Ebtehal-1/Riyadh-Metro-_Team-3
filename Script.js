document.addEventListener("DOMContentLoaded", function () {
    // الزر الأول
    const button = document.getElementById("GoToReports");
    if (button) {
        button.addEventListener("click", function () {
            window.location.href = "RMetroReports.html"; // المسار الصحيح
        });
    }

    // الزر الثاني
    const button2 = document.getElementById("GoToIncidentManagement");
    if (button2) {
        button2.addEventListener("click", function () {
            window.location.href = "RMetroIncident.html"; // المسار الصحيح
        });
    }

    // الزر الثالث
    const buttonHome = document.getElementById("HomePage");
    if (buttonHome) {
        buttonHome.addEventListener("click", function () {
            window.location.href = "RMetroAdminPage.html"; // المسار الصحيح
        });
    }

    //الزر الرابع
    const buttonSched = document.getElementById("GoToTrainSchedule");
    if (buttonSched) {
        buttonSched.addEventListener("click", function () {
            window.location.href = "RMetroTrain.html"; // المسار الصحيح
        });
    }
});

// الزر الثالث
const buttonMaint = document.getElementById("GoToMaintenance");
if (buttonMaint) {
    buttonMaint.addEventListener("click", function () {
        window.location.href = "RMetroMaintane.html"; // المسار الصحيح
    });
}
const button1 = document.getElementById("bottun1");
if (button1) {
    button1.addEventListener("click", function () {
        window.location.href = "button1.html"; // المسار الصحيح
    });
}
const button2 = document.getElementById("bottun2");
if (button2) {
    button2.addEventListener("click", function () {
        window.location.href = "button2.html"; // المسار الصحيح
    });
}
const button3 = document.getElementById("bottun3");
if (button3) {
    button3.addEventListener("click", function () {
        window.location.href = "button3.html"; // المسار الصحيح
    });
}
const button4 = document.getElementById("bottun4");
if (button4) {
    button4.addEventListener("click", function () {
        window.location.href = "button4.html"; // المسار الصحيح
    });
}
