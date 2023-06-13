window.onload = function() {
    document.getElementById('uploadForm').addEventListener('submit', convertToWord);
  };
  
  function convertToWord(event) {
    event.preventDefault();
    
    const form = event.target;
    const fileInput = document.getElementById('pdfFile');
    
    const formData = new FormData();
    formData.append('pdfFile', fileInput.files[0]);
    
    fetch('new.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        const downloadLink = document.getElementById('downloadLink');
        downloadLink.href = data.downloadLink;
        downloadLink.innerText = 'Download Word File';
        downloadLink.style.display = 'block';
      } else {
        alert('Conversion failed. Please try again.');
      }
    })
    .catch(error => {
      alert('An error occurred. Please try again later.');
      console.error(error);
    });
  }