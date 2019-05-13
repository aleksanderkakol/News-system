// let url = './login.php';
// let thead = $('.table thead tr');
// let tbody = $('.table tbody');
// window.onload = function() {
//   $.ajax({
//     type: 'post',
//     url: url,
//     dataType: 'json',
//     success: function(data, status) {
//       if (status === 'success') {
//         let keys = Object.keys(data[0]);
//         for (let i = 0; i < keys.length; i++) {
//           thead.append('<th>' + keys[i] + '</th>');
//         }
//         for (let item of data) {
//           let tr = $("<tr></tr>");
//           tbody.append(tr);
//           tr.append('<td>' + item.name + '</td> ');
//           tr.append('<td>' + item.description + '</td> ');
//           tr.append('<td>' + item.is_active + '</td> ');
//           tr.append('<td>' + item.author_id + '</td> ');
//           tr.append('<td>' + item.created_at + '</td> ');
//           tr.append('<td>' + item.updated_at + '</td> ');
//         }
//       } else {
//         console.log('Błąd pobierania danych');
//       }
//     },
//     error: function(status, txt, error) {
//       console.log(txt);
//       console.log(error);
//     },
//     complete: function(data, status) {
//       console.log(status);
//     }
//   });
// }
// let news_btn = document.querySelector('.news_btn');
// let news_form = document.querySelector('.wrap');
// news_btn.addEventListener('click', function() {
//   news_form.style.display = 'block';
// })
//
// let abort_btn = document.querySelector('.abort');
// abort_btn.addEventListener('click', function(e) {
//   e.preventDefault();
//   news_form.style.display = 'none';
// })