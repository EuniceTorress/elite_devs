<style>
    #editManpowerModal .modal-content {
        caret-color: transparent;
        background-color: #fff;
        display: flex;
        flex-direction: column;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    #editManpowerModal .modal-header {
        border-bottom: 1px solid #ddd;
        flex-shrink: 0;
        padding: 20px 0 20px 20px;
    }

    #editManpowerModal .modal-title {
        margin: 0;
        text-align: left;
    }

    #editManpowerModal .modal-header .close {
        position: relative;
        margin-right: 10px;
        margin-top: -5px;
        margin-left: 0;
        background-color: transparent;
        transition: 0.3s all ease;
        outline: none !important;
        box-shadow: none !important;
        border: none;
        padding: 10px;
        font-size: 1.3rem;
        color: #1c1e21;
        text-decoration: none;
        border-radius: 8px;
        transition: background-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }

    #editManpowerModal .modal-header .close:hover {
        background-color: #f0f2f5;
        color: maroon;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        transform: translateY(-0.5px);
    }

    #editManpowerModal .modal-body {
        padding: 20px 30px;
        background-color: #f8f9fa;
    }

    #editManpowerModal .form-group label {
        font-weight: 600;
        color: #333;
    }

    #editManpowerModal .form-control {
        border-radius: 8px;
        padding: 10px;
        font-size: 0.95rem;
        border: 1px solid #ced4da;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.075);
    }

    #editManpowerModal .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
    }

    #editManpowerModal .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        border-radius: 8px;
        padding: 10px 15px;
        font-size: 1rem;
        font-weight: 500;
    }

    #editManpowerModal .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    @media (max-width: 768px) {
        #editManpowerModal .modal-body {
            padding: 15px;
        }
    }
</style>

<div class="modal fade" id="editManpowerModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editManpowerModalLabel">Edit Manpower</h5>
                <span class="close" id="editManpowerClose">&times;</span>
            </div>
            <div class="modal-body">
                <form id="editManpowerForm">
                    <div class="form-group">
                        <label for="manpower-id">Manpower ID</label>
                        <input type="text" class="form-control" id="manpower-id" readonly>
                    </div>
                    <div class="form-group">
                        <label for="manpower-name">Manpower Name</label>
                        <input type="text" class="form-control" id="manpower-name" required>
                    </div>
                    <div class="form-group">
                        <label for="manpower-price">Price</label>
                        <input type="number" class="form-control" id="manpower-price" required>
                    </div>
                    <div class="form-group">
                        <label for="manpower-status">Status</label>
                        <select class="form-control" id="manpower-status">
                            <option value="Available">Available</option>
                            <option value="Unavailable">Unavailable</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('editManpowerClose').onclick = function() {
        $('#editManpowerModal').modal('hide');
    };

    var efModal = document.getElementById("editManpowerModal");

    window.onclick = function(event) {
        if (event.target === efModal) {
            $('#editManpowerModal').modal('hide');
        }
    };

    function populateModal(id, name, price, status) {
        document.getElementById('manpower-id').value = id;
        document.getElementById('manpower-name').value = name;
        document.getElementById('manpower-price').value = price;
        document.getElementById('manpower-status').value = status;
    }

    document.getElementById('editManpowerForm').addEventListener('submit', function(e) {
        e.preventDefault();

        let updatedId = document.getElementById('manpower-id').value;
        let updatedName = document.getElementById('manpower-name').value;
        let updatedPrice = document.getElementById('manpower-price').value;
        let updatedStatus = document.getElementById('manpower-status').value;

        $('#editManpowerModal').modal('hide');
    });

    document.querySelectorAll('.edit-icon').forEach(function(icon) {
        icon.addEventListener('click', function() {
            const row = this.closest('tr');
            const manpowerId = row.querySelector('.manpower-id').textContent;
            const manpowerName = row.querySelector('.manpower-name').textContent;
            const manpowerPrice = row.querySelector('.manpower-price').textContent;
            const manpowerStatus = row.querySelector('.manpower-status').textContent;

            openEditModal(manpowerId, manpowerName, manpowerPrice, manpowerStatus);
        });
    });
</script>
