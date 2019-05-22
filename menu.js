let url = './menu.php';
let article = $('.article');
let div = $('.wraper_error');
let thead = $('.table thead tr');
let tbody = $('.table tbody');

window.onload = function() {
  $.ajax({
    type: 'post',
    url: url,
    dataType: 'json',
    success: function(data, status) {
      if (status === 'success' && data.length > 0) {
        let keys = Object.keys(data[0]);
        for (let i = 0; i < keys.length; i++) {

          thead.append('<th>' + keys[i] + '</th>');
        }
        thead.append('<th>Opcje</th> ');
        for (const [index, item] of data.entries()) {

          let tr = $(`<tr row_id=${item.id} ></tr>`);
          tbody.append(tr);
          tr.append(`<td><div col_name='id' class="row_data">${item.id}</div></td>`);
          tr.append(`<td><div col_name='name' class="row_data">${item.name}</div></td>`);
          tr.append(`<td><div col_name='description' class="row_data">${item.description}</div></td>`);
          tr.append(`<td><div col_name='is_active' class="row_data">${item.is_active}</div></td>`);
          tr.append('<td><div>' + item.created_at + '</div></td> ');
          tr.append('<td><div>' + item.updated_at + '</div></td> ');
          tr.append('<td><div>' + item.author + '</div></td> ');
          tr.append("<td><div class='options'><button class='btn_edit' alt='Edytuj'>Edytuj</button><button class='btn_save' alt='Zapisz'>Zapisz</button><button class='btn_delete' alt='Usuń'>Usuń</button><button class='btn_cancel' alt='Anuluj'>Anuluj</button></div></td>");
        }
      }
      $(document).find('.btn_save').hide();
      $(document).find('.btn_cancel').hide();
      $(document).find('.btn_delete').hide();


      if (data['status'] === "false") {
        div.append("<h2 class='error'>" + data.message + "</h2><a class='logout' href='index.html' alt='Login'>Zaloguj ponownie</a>");
        div.css("display", "flex");
        article.css("display", "none");
      }
    },
    error: function(status, txt, error) {
      console.log(txt);
      console.log(error);
    },
    complete: function(data, status) {
      console.log(status);
    }
  });

  $(document).on('click', '.btn_edit', function(event) {
    event.preventDefault();
    var tbl_row = $(this).closest('tr');
    var row_id = tbl_row.attr('row_id');

    tbl_row.find('.btn_save').show();
    tbl_row.find('.btn_cancel').show();
    tbl_row.find('.btn_delete').show();
    tbl_row.find('.btn_edit').hide();

    tbl_row.find('.row_data')
      .attr('contenteditable', 'true')
      .attr('edit_type', 'button')
      .addClass('bg-warning')
      .css('padding', '3px');


    tbl_row.find('.row_data').each(function(index, val) {
      $(this).attr('original_entry', $(this).html());
    });

  });

  $(document).on('click', '.btn_cancel', function(event) {
    event.preventDefault();
    var tbl_row = $(this).closest('tr');
    var row_id = tbl_row.attr('row_id');

    tbl_row.find('.btn_save').hide();
    tbl_row.find('.btn_cancel').hide();
    tbl_row.find('.btn_delete').hide();
    tbl_row.find('.btn_edit').show();

    tbl_row.find('.row_data')
      .attr('contenteditable', 'false')
      .attr('edit_type', 'click')
      .removeClass('bg-warning')

    tbl_row.find('.row_data').each(function(index, val) {
      $(this).html($(this).attr('original_entry'));
    });
  });


  $(document).on('click', '.btn_save', function(event) {
    event.preventDefault();
    var tbl_row = $(this).closest('tr');

    tbl_row.find('.btn_save').hide();
    tbl_row.find('.btn_cancel').hide();
    tbl_row.find('.btn_delete').hide();
    tbl_row.find('.btn_edit').show();

    tbl_row.find('.row_data')
      .attr('contenteditable', 'false')
      .attr('edit_type', 'click')
      .removeClass('bg-warning');

    var arr = {};
    tbl_row.find('.row_data').each(function(index, val) {
      var col_name = $(this).attr('col_name');
      var col_val = $(this).html();
      arr[col_name] = col_val;
    })
    let request = $.ajax({
      url: "./save.php",
      type: "post",
      data: arr
    });
    request.done(function(response, textStatus, jqXHR) {
      console.log(textStatus);
    });
    request.fail(function(jqXHR, textStatus, errorThrown) {
      console.error(
        "The following error occurred: " +
        textStatus, errorThrown
      );
    });
    request.always(function() {
      console.log("Zapisano!");
    });
  });

}

let news_btn = document.querySelector('.news_btn');
let news_form = document.querySelector('.wrap');
news_btn.addEventListener('click', function() {
  news_form.style.display = 'block';
})

let abort_btn = document.querySelector('.abort');
abort_btn.addEventListener('click', function(e) {
  e.preventDefault();
  news_form.style.display = 'none';
})