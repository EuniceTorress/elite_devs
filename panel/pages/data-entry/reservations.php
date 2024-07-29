<style>
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 1px solid rgba(0,0,0,0.1);
            padding-bottom: 20px;
        }

        .form-container .lb {
            margin-top: 20px;
            text-align: justify:
        }

        .form-group label {
            font-weight: bold;
            font-size: 14px;
            display: block;
            margin-bottom: 5px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.5rem;
            border: 1px solid #ced4da;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            font-size: 15px;
        }

        .form-control::placeholder {
            font-size: 13px;
            color: #6c757d;
        }

        .form-control:focus {
            border-color: maroon;
            outline: none;
            box-shadow: 0 0 0 0.1rem rgba(128,0,0,0.2);
        }

        .checkbox-group label {
            margin-right: 20px;
            display: inline-block;
        }

        .table thead th {
            background-color: #f8f9fa;
        }

        .amount {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin-top: 10px;
            padding: 5px 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            background-color: #f8f9fa;
            display: inline-block;
        }

        .amount .value {
            color: #007bff;
        }

        @media (max-width: 768px) {
            .amount {
                font-size: 14px;
                padding: 4px 8px;
            }
        }

        @media (max-width: 576px) {
            .amount {
                font-size: 12px;
                padding: 3px 6px;
            }
        }

        #facility-container .form-group i,
        #manpower-container .form-group i {
            font-size: 10px;
            margin-right: 5px;
        }

        #facility-container .form-group button,
        #manpower-container .form-group button {
            font-size: 13px;
            border-radius: 50px;
            outline: none;
            box-shadow: none;
        }

        .other-facility-details,
        .other-manpower-details {
            display: none;
        }

        .form-group select {
            font-size: 14px;
            padding: 5px;
            width: 100%;
            box-sizing: border-box;
            text-overflow: ellipsis;
        }

        .form-group select option {
            padding: 10px;
        }

        .form-container #facility-container .btn-danger,
        .form-container #manpower-container .btn-danger {
            height: 2.3rem;
            font-size: 13px;
            border-radius: 50px;
            outline: none;
            box-shadow: none;
            margin-top: 25px;
            margin-left: 20px;
        }

        .submit-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }   

        .submit-container .btn-success {
            border-radius: 50px;
            outline: none;
            box-shadow: none;
            width: 120px;
        }

    </style>
    <div class="form-container py-3">
        <h2>Merchandise Order Slip</h2>
        <form class="mx-3 px-5">
            <div class="ml-3 form-group col-5">
                <select class="form-control" name="manpower[]" required>
                    <option value="">Select Purchase</option>
                    <option value="Electrician">Merchandise</option>
                    <option value="Technician">Uniform</option>
                    <option value="Janitors">Book</option>
                </select>
            </div>
            <div class="row mt-5">
                <p class="lb col-2">Customer Name: </p>
                <div class="form-group col-2">
                    <label for="firstName">First Name:</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                </div>
                <div class="form-group col-2">
                    <label for="middleName">Middle Name:</label>
                    <input type="text" class="form-control" id="middleName" name="middleName" required>
                </div>
                <div class="form-group col-2">
                    <label for="lastName">Last Name:</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" required>
                </div>
                <div class="form-group col-1">
                    <label for="suffix">Suffix:</label>
                    <input type="text" class="form-control" id="suffix" name="suffix" placeholder="Optional">
                </div>
                <div class="form-group col-2 ml-auto">
                    <label for="contactNumber">Contact Number:</label>
                    <input type="tel" class="form-control" id="contactNumber" name="contactNumber" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-2">
                    <label for="expectedNumberOfGuests">SR-Code: </label>
                    <input type="number" class="form-control eg" id="expectedNumberOfGuests" name="expectedNumberOfGuests" required>
                </div>
                <div class="form-group col-4">
                    <label for="purpose">Program: </label>
                    <input type="text" class="form-control" id="purpose" name="purpose" required>
                </div>
            </div>
            <div class="submit-container">
                <button type="submit" class="btn btn-success">Submit<i class="ml-2 fas fa-arrow-right"></i></button>
            </div>
        </form>
    </div>

    <script>

    </script>