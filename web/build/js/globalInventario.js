$(document).ready(function () {
  $(document).on("click", ".menu", function () {
    var estado = $("#logo").attr("data-estado");

    if (estado == 1) {
      $("#logo").attr("src", "images/logo-pequeño.png");
      $("#logo").attr("width", "40px");
      $("#logo").attr("style", "margin-left:5px");
      $("#logo").attr("data-estado", "2");
    } else {
      $("#logo").attr("src", "images/logo.png");
      $("#logo").attr("width", "140px");
      $("#logo").attr("style", "margin-left:15px");
      $("#logo").attr("data-estado", "1");
    }
  });

  /**Modal */
  $(document).on("click", "#modalInventario", function () {
    var url = $(this).attr("data-url");
    var dato = $(this).attr("data-id");
    var title = $(this).attr("value");

    if (dato == "") {
      dato = 0;
    }

    $.ajax({
      url: url,
      data: "datos=" + dato,
      type: "POST",
      success: function (datos) {
        $("#contenedor").html(datos);
        $("#titulo").html(title); //titulo de la modal Ok no tocar 🚫
        $("#modal").modal("show");
      },
    });
  });

  // /Modal/
  /*¨*Clonador del div entrada masiva */
  function Clonador() {
    contenido = $(".shadow:first-child")
      .clone()
      .prepend(
        "<div class='my-1 mb-0'>" +
          "<button type='button' title='cerrar' id='eliminar' class='btn btn-danger float-right'>" +
          "<i class='fa fa-times'></i>" +
          "</button>" +
          "</div>"
      )
      .css({ animation: "slideInDown", "animation-duration": "1s" })
      .appendTo("#conten");
    $("#send").prop("disabled", true);
  }

  $("#agregarDiv").click(Clonador);
  // /¨Clonador del div entrada masiva/

  /*¨*Validar Campos */

  let camposbien = false;

  $(document).on("change", function (e) {
    seleccion = $("select");
    entrada = $("input");

    var campos = $("select").length + $("input").length; //3
    var habilitarEnvio = 0;

    $.each(seleccion, function (indice, valor) {
      if ($(valor).val() == 0) {
      } else {
        habilitarEnvio++;
      }
    });
    $.each(entrada, function (indice, valor) {
      let inputValor = $(valor).val();

      if (inputValor > 0) {
        habilitarEnvio++;
        $("#send").prop("disabled", false);
      } else {
        $("#send").prop("disabled", true);
        $("#send").click(function (e) {
          e.preventDefault();
        });
      }
    });
    if (habilitarEnvio == campos) {
      $("#send").prop("disabled", false);
      camposbien = true;
    } else {
      camposbien = 1;
      $("#send").prop("disabled", true);
      $("#send").click(function (e) {
        e.preventDefault();
      });
    }
  });

  function clickValidador(e) {
    $("form").addClass("was-validated");
    e.preventDefault();
  }

  $("#send").click(function (e) {
    e.preventDefault();
    if (camposbien) {
      swal({
        title: "¿Esta seguro que desea realizar esta accion?",
        text: "Se actualizaran a los datos diligenciados.",
        icon: "info",
        buttons: {
          cancel: {
            visible: true,
            text: "Cancelar",
            className: "btn btn-danger",
          },
          confirm: {
            text: "Agregar",
            className: "btn btn-success",
          },
        },
      }).then((Delete) => {
        if (Delete) {
          $("#send").off("click");
          $(this).click();
        }
      });
    } else {
      clickValidador();
    }
  });

  var fechaInicial = "";
  var fechaFinal = "";

  $(document).on("focus change", "#fecha_inicial", function () {
    fechaInicial = $(this).val();

    var f = new Date();
    var fechita;

    if (f.getMonth() < 10) {
      var mes = "0" + (f.getMonth() + 1);
      fechita = f.getFullYear() + "-" + mes + "-" + f.getDate();
    }
    this.max = fechita;

    if (fechaInicial) {
      $("#fecha_final").prop("required", true);
    }
  });

  $(document).on("focus change", "#fecha_final", function () {
    fechaFinal = $(this).val();
    if (fechaInicial) {
      this.min = fechaInicial;
    }
    if (fechaFinal) {
      $("#fecha_inicial").prop("required", true);
    }
  });

  $("#reporteActividades").click(function (e) {
    if (fechaInicial > fechaFinal) {
      $("#generarPdfInventario").click(function (e) {
        e.preventDefault();
      });
    } else if (fechaInicial == fechaFinal) {
      $("#generarPdfInventario").click(function (e) {
        e.preventDefault();
      });

      $("#alertaFechasIguales")
        .removeClass("d-none")
        .html("Por favor seleccione fechas diferentes.");
    } else {
      $("#generarPdfInventario").off("click");
      $("#alertaFechasIguales").addClass("d-none"); //aleta roja
    }
  });

  /*¨*Eliminar el div agreagado */
  $(document).on("click", "#eliminar", function () {
    $(this).parent().parent().remove();
  });
  // /¨Eliminar el div agreagado/

  /**Envio el valor del selector tipo materia */
  $(document).on("change", "#tipo", function () {
    var cualquier = $(this).parent().parent().parent();
    var id = $(this).val();
    var url = $(this).attr("data-url");
    $.ajax({
      url: url,
      data: "id=" + id,
      type: "POST",
      success: function (datos) {
        cualquier
          .find("#Articulos")
          .html(
            "<option selected disabled value=''>Selecione...</option>" + datos
          );
      },
    });
  });
  // /Envio el valor del selector tipo materia/
  var cantidadGlobal = 0;
  $(document).on("change", "#Articulos", function () {
    let cantidad;
    var padre = $(this).parents();
    var vale = $(this).val();
    var url = $(this).attr("data-url");

    $.ajax({
      url: url,
      data: "vale=" + vale,
      type: "POST",
      success: function (datos) {
        cantidadGlobal = datos;
        cantidad = datos;
        padre
          .find("#contieneInput")
          .html(
            '<label for="Arti_cantidad">Cantidad</label>' +
              '<input type="number" id="Arti_cantidad" name="Arti_cantidad[]" class="form-control" min="0" max="' +
              cantidad +
              '">' +
              '<input id="nomeven" type="hidden" value="' +
              cantidad +
              '">'
          );
        $("#send").prop("disabled", true);
      },
    });
  });

  $(document).on("change keyup", "#Arti_cantidad", function () {
    let padre = $(this).parent().parent();
    let can = padre.find("#nomeven").val();
    let esteinput = parseInt($(this).val());
    if (esteinput > cantidadGlobal) {
      padre.find("#Arti_cantidad").val(cantidadGlobal);
    }
  });

  /**mensaje agrego exitosamente */
  $("#message").css({ animation: "slideInDown", "animation-duration": "1s" });
  setTimeout(function () {
    $("#message").fadeOut();
  }, 3000);
  /*Mensaje agrego exitosamente*/

  /**Agregar una nueva car con pulsar el + */
  $(document).keypress(function (eTecla) {
    if (eTecla.which == 43) {
      Clonador();
    }
  });
  // /Agregar una nueva car con pulsar el +/
});
