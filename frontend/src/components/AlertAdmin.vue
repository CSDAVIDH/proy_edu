<script>
import Swal from "sweetalert2";

export const show_alerta = (msj) => {
    Swal.fire({
        width: 250,
        html:
            '<div class="alert_container"><i class="fa-solid fa-check border_alert_green"></i><span class="alert_green">' +
            msj +
            "</span></div>",
        buttonsStyling: true,
        position: "top-end",
        background: "#fff",
        color: "#716add",
        backdrop: `rgba(255,255,255,0.1)`,
        showConfirmButton: false,
        timer: 1000,
        showClass: {
            popup: "animate__animated animate__fadeInDown",
        },
        hideClass: {
            popup: "animate__animated animate__fadeOutUp",
        },
        customClass: {
            popup: "swal-wide",
            icon: "icon-class",
        },
    });
};

export const danger_alerta = (msj) => {
    Swal.fire({
        width: 250,
        html:
            '<div class="alert_container"><i class="fa-solid fa-x border_alert_red"></i><span class="alert_red">' +
            msj +
            "</span></div>",
        buttonsStyling: true,
        position: "top-end",
        background: "#fff",
        color: "#716add",
        backdrop: `rgba(255,255,255,0.1)`,
        showConfirmButton: false,
        timer: 1000,
        showClass: {
            popup: "animate__animated animate__fadeInDown",
        },
        hideClass: {
            popup: "animate__animated animate__fadeOutUp",
        },
        customClass: {
            popup: "swal-wide",
            icon: "icon-class",
        },
    });
};
</script>
<style>
.alert_container {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.alert_container i {
    width: 30px;
    font-size: 16px;
    margin-right: 5px;
    padding: 5px;
    border-radius: 50%;
    border-width: 1px;
    border-style: solid;
    border-color: #a3c0ade1;
    background-color: #fff;
}

.alert_container span {
    font-size: 16px;
}

.alert_red {
    color: #b91111;
}

.alert_green {
    color: #066826e1;
}

.alert_blue {
    color: rgb(29, 29, 199);
}

.alert_orange {
    color: rgb(221, 82, 17);
}

.alert_container i.border_alert_red {
    color: #b91111;
    border-color: #b91111;
}

.alert_container i.border_alert_green {
    color: #066826e1;
    border-color: #066826e1;
}

.alert_container i.border_alert_blue {
    color: rgb(29, 29, 199);
    border-color: rgb(29, 29, 199);
}

.alert_container i.border_alert_orange {
    color: rgb(221, 82, 17);
    border-color: rgb(221, 82, 17);
}
</style>
