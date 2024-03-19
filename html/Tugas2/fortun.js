var tampilanInputs;
var data = [];
var radio = [];
var pilihanElement;

document.getElementById("btn").addEventListener("click", function (e) {

  var nama = document.getElementById("nama").value.trim();
    var jumlah = document.getElementById("jumlah").value.trim();
    var nameError = document.getElementById("nameError");

    // Validasi input nama
    if (nama === "") {
        nameError.textContent = "Nama tidak boleh kosong";
        return;
    } else if (!/^[a-zA-Z\s]+$/.test(nama)) {
        nameError.textContent = "Nama hanya boleh berisi huruf";
        return;
    } else {
        nameError.textContent = ""; // Hapus pesan kesalahan jika nama valid
    }

    // Validasi input jumlah
    if (jumlah === "") {
        nameError.textContent = "Jumlah tidak boleh kosong";
        return;
    } else if (isNaN(jumlah) || parseInt(jumlah) < 1) {
        nameError.textContent = "Jumlah harus merupakan angka positif";
        return;
    } else {
        nameError.textContent = ""; // Hapus pesan kesalahan jika jumlah valid
    }

  textInput();
  this.remove();
});

function textInput() {
  var jumlah = document.getElementById("jumlah").value;
  tampilanInputs = document.getElementById("tampilanInputs");
  tampilanInputs.innerHTML = "";

  var input = [];

  for (var i = 1; i <= jumlah; i++) {
    var label = document.createElement("label");
    label.textContent = "Pilihan " + i + ":";
    input[i - 1] = document.createElement("input");
    input[i - 1].type = "text";
    input[i - 1].name = "teksTampilan" + i;

    tampilanInputs.appendChild(label);
    tampilanInputs.appendChild(input[i - 1]);
    tampilanInputs.appendChild(document.createElement("br"));
  }

  var button = document.createElement("button");
  button.type = "button";
  button.id = "buttonOK";
  button.textContent = "OK";

  tampilanInputs.appendChild(button);
  tampilanInputs.appendChild(document.createElement("br"));
  tampilanInputs.appendChild(document.createElement("br"));

  document.getElementById("buttonOK").addEventListener("click", function (e) {
    for (var i = 1; i <= jumlah; i++) {
      data[i - 1] = input[i - 1].value;
    }

    textRadio();
    this.remove();
  });
}

function textRadio() {
  var jumlah = document.getElementById("jumlah").value;
  var label;

  // Menampilkan pilihan yang dimasukkan pengguna sebelumnya
  for (var i = 0; i < data.length; i++) {
    label = document.createElement("label");
    label.textContent = "Pilihan: ";
    label.innerHTML =
      '<input type="radio" name="teksTampilan" id="Radio' +
      (i + 1) +
      '">' +
      data[i];
    label.setAttribute("for", "Radio" + (i + 1));
    tampilanInputs.appendChild(label);
  }

  // Menampilkan pilihan baru yang dimasukkan pengguna
  for (var i = data.length + 1; i <= jumlah; i++) {
    label = document.createElement("label");
    label.textContent = "Pilihan " + i + ": " + data[i - 1]; // Menampilkan pilihan yang diketikkan pengguna sebelumnya
    tampilanInputs.appendChild(label);

    label = document.createElement("label");
    label.innerHTML =
      '<input type="radio" name="teksTampilan" id="Radio' +
      i +
      '">' +
      data[i - 1];
    label.setAttribute("for", "Radio" + i);
    tampilanInputs.appendChild(label);
  }

  // Memperbarui array radio
  radio = [];
  for (var i = 1; i <= jumlah; i++) {
    radio.push(document.getElementById("Radio" + i));
    radio[i - 1].addEventListener("click", function (e) {
      var radios = document.getElementsByName(this.name);

      radios.forEach(function (x) {
        x.checked = false;
      });

      this.checked = true;
    });
  }

  // Menambahkan button OK
  var button = document.createElement("button");
  button.name = "buttonLast";
  button.textContent = "OK";
  button.id = "buttonLast";
  tampilanInputs.appendChild(button);
  tampilanInputs.appendChild(document.createElement("br"));

  // Menambahkan event listener untuk button OK
  document.getElementById("buttonLast").addEventListener("click", function (e) {
    tampilkanData();
    this.remove();
  });
}


function tampilkanData() {
  var nama = document.getElementById("nama").value;
  var jumlah = document.getElementById("jumlah").value;
  var pilihanText = document.createElement("p");
  var tampilanInputs = document.getElementById("tampilanInputs");
  var radioButtons = document.getElementsByName("teksTampilan");

  pilihanText.textContent =
      "Halo, nama saya: " + nama + ", saya memiliki " + jumlah + " pilihan:";

  if (!pilihanElement) {
      pilihanElement = document.createElement("div");
      tampilanInputs.appendChild(pilihanElement);
  }

  pilihanElement.innerHTML = "";
  pilihanElement.appendChild(pilihanText);

  // Menampilkan semua pilihan
  for (var i = 0; i < radioButtons.length; i++) {
      var pilihanElement = document.createElement("p");
      pilihanElement.textContent = "Pilihan " + (i + 1) + ": " + radioButtons[i].nextSibling.textContent;
      tampilanInputs.appendChild(pilihanElement);
  }

  // Menampilkan pilihan yang dipilih
  var pilihanDipilih = "";
  for (var i = 0; i < radioButtons.length; i++) {
      if (radioButtons[i].checked) {
          pilihanDipilih = radioButtons[i].nextSibling.textContent;
          break;
      }
  }
  var pilihanDipilihElement = document.createElement("p");
  pilihanDipilihElement.textContent =
      "Pilihan yang saya pilih adalah: " + pilihanDipilih;
  tampilanInputs.appendChild(pilihanDipilihElement);
}











