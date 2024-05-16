<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Student Passport Layout Card</title>
    <!-- Add Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Export Candiate Passport</h3>
            </div>
            <div class="card-body">
                <form method="post"  action="{{ route('export.passport') }}" >
                    @csrf
                    <div class="mb-3">
                        <label for="session" class="form-label">Select Session:</label>
                        <select id="session" name="session" class="form-select">
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                         </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-lg">Export</button>
                   <a style="float:right;" href="{{ route('dashboard') }}" class="btn btn-secondary btn-lg">Back</a>

                </form>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>

    <!-- Add Bootstrap JS and Popper.js CDN (required for certain Bootstrap components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
