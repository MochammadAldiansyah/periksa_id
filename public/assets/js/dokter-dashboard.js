// Dokter Dashboard - Approve Modal Functions
function openApproveModal(id, patientName) {
    document.getElementById('approvePatientName').innerText = patientName;
    document.getElementById('approveForm').action = '/dokter/janji-temu/' + id + '/approve';
    document.getElementById('approveModal').classList.remove('hidden');
    document.getElementById('approveModal').classList.add('flex');
}

function closeApproveModal() {
    document.getElementById('approveModal').classList.add('hidden');
    document.getElementById('approveModal').classList.remove('flex');
}
