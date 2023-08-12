const down = document.getElementById('down')

function downloadContract() {
  const contractElement = document.querySelector('.contract')
  const opt = {
    margin: [0, 0],
    filename: 'employee_contract.pdf',
    image: {
      type: 'jpeg',
      quality: 0.98,
    },
    html2canvas: {
      scale: 2,
    },
    jsPDF: {
      unit: 'mm',
      format: 'a4',
      orientation: 'portrait',
    },
  }

  // Generate the PDF
  html2pdf().from(contractElement).set(opt).save()
}
down.addEventListener('click', downloadContract)
