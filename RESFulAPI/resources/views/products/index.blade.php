<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sản Phẩm</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #fcfcfc;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }
        .navbar-custom {
            background-color: #2e74f0; /* Blue matching screenshot */
        }
        .navbar-brand {
            font-weight: 500;
        }
        .nav-link {
            font-weight: 400;
            opacity: 0.9;
        }
        .nav-link.active {
            opacity: 1;
            font-weight: 500;
        }
        .content-container {
            max-width: 1200px;
            margin: 0 auto;
            padding-top: 30px;
        }
        .page-title {
            font-size: 28px;
            font-weight: 600;
            color: #333;
        }
        .btn-add {
            background-color: #3b7ced;
            color: white;
            border: none;
            padding: 8px 16px;
            font-weight: 500;
        }
        .btn-add:hover {
            background-color: #2b65d1;
            color: white;
        }
        .card-table {
            border: 1px solid #eaeaea;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
            background: white;
        }
        .table {
            margin-bottom: 0;
        }
        .table thead th {
            border-bottom: 2px solid #f0f0f0;
            background-color: #fff;
            color: #000;
            font-size: 14px;
            font-weight: 600;
            padding: 16px;
        }
        .table tbody td {
            vertical-align: middle;
            font-size: 14px;
            color: #444;
            padding: 12px 16px;
            border-bottom: 1px solid #f5f5f5;
        }
        .table-striped > tbody > tr:nth-of-type(odd) > * {
            background-color: #f9f9f9;
        }
        .btn-action {
            padding: 4px 10px;
            font-size: 13px;
            border-radius: 4px;
            color: white !important;
            border: none;
        }
        .btn-edit {
            background-color: #49b5d6; /* Light blue/cyan for Sửa */
        }
        .btn-edit:hover {
            background-color: #3aa2c1;
        }
        .btn-delete {
            background-color: #dd4b54; /* Red for Xóa */
        }
        .btn-delete:hover {
            background-color: #c94048;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom py-2">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="#">Demo API</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-white-50" href="/prodtypes">Loại Sản Phẩm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/products">Sản Phẩm</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="content-container px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="page-title mb-0">Quản lý Sản Phẩm</h1>
        <button class="btn btn-add rounded" onclick="showCreateModal()">
            <i class="fas fa-plus-circle me-1"></i> Thêm mới
        </button>
    </div>

    <div class="card card-table">
        <div class="card-body p-0">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="width: 10%;">ID</th>
                        <th style="width: 25%;">Tên Sản Phẩm</th>
                        <th style="width: 30%;">Mô tả</th>
                        <th style="width: 20%;">Loại SP</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody id="productTableBody">
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Đang tải dữ liệu...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Thêm/Sửa -->
<div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light border-bottom-0">
                <h5 class="modal-title fw-bold" id="modalTitle">Thêm Sản Phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <input type="hidden" id="productId">
                <div class="mb-3">
                    <label for="productName" class="form-label fw-medium">Tên Sản Phẩm <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="productName" required>
                </div>
                <div class="mb-3">
                    <label for="productDesc" class="form-label fw-medium">Mô tả</label>
                    <textarea class="form-control" id="productDesc" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="productType" class="form-label fw-medium">Loại Sản Phẩm <span class="text-danger">*</span></label>
                    <select class="form-select" id="productType" required>
                        <option value="">-- Chọn Loại SP --</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer border-top-0 bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary px-4" onclick="saveProduct()">Lưu</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function showNotification(message, type = 'success') {
        const containerId = 'notification-container';
        let container = document.getElementById(containerId);
        if (!container) {
            container = document.createElement('div');
            container.id = containerId;
            container.style.position = 'fixed';
            container.style.top = '20px';
            container.style.left = '50%';
            container.style.transform = 'translateX(-50%)';
            container.style.zIndex = '9999';
            document.body.appendChild(container);
        }

        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show shadow-sm`;
        alertDiv.role = 'alert';
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        container.appendChild(alertDiv);

        setTimeout(() => {
            if (alertDiv && document.body.contains(alertDiv)) {
                alertDiv.classList.remove('show');
                setTimeout(() => alertDiv.remove(), 150);
            }
        }, 3000);
    }

    const API_PRODUCTS_URL = '/api/products';
    const API_PRODTYPES_URL = '/api/prodtypes';
    let productModal;
    let prodTypesMap = {};

    document.addEventListener("DOMContentLoaded", function() {
        productModal = new bootstrap.Modal(document.getElementById('productModal'));
        loadProdTypesForSelect().then(() => loadProducts());
    });

    function loadProdTypesForSelect() {
        return fetch(API_PRODTYPES_URL)
            .then(res => res.json())
            .then(data => {
                const select = document.getElementById('productType');
                select.innerHTML = '<option value="">-- Chọn Loại SP --</option>';
                
                if (data.EC === 0 && data.DT.length > 0) {
                    data.DT.forEach(item => {
                        select.innerHTML += `<option value="${item.Id}">${item.Name}</option>`;
                        prodTypesMap[item.Id] = item.Name;
                    });
                }
            })
            .catch(err => console.error('Lỗi tải dropdown loại SP', err));
    }

    function loadProducts() {
        fetch(API_PRODUCTS_URL)
            .then(res => res.json())
            .then(data => {
                const tbody = document.getElementById('productTableBody');
                tbody.innerHTML = '';
                
                if (data.EC === 0 && data.DT.length > 0) {
                    data.DT.forEach(item => {
                        const typeName = item.prod_type ? item.prod_type.Name : (prodTypesMap[item.FK_ProdType] || item.FK_ProdType);
                        tbody.innerHTML += `
                            <tr>
                                <td class="fw-medium">${item.Id}</td>
                                <td>${item.Name}</td>
                                <td>${item.Description || ''}</td>
                                <td>${typeName}</td>
                                <td>
                                    <button class="btn btn-action btn-edit me-1" onclick="showEditModal(${item.Id}, '${item.Name}', '${item.Description || ''}', ${item.FK_ProdType})">
                                        <i class="fas fa-pen fa-xs"></i> Sửa
                                    </button>
                                    <button class="btn btn-action btn-delete" onclick="deleteProduct(${item.Id})">
                                        <i class="fas fa-trash fa-xs"></i> Xóa
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4 text-muted">Chưa có dữ liệu.</td></tr>';
                }
            })
            .catch(err => {
                console.error(err);
                showNotification('Lỗi tải dữ liệu sản phẩm!', 'danger');
            });
    }

    function showCreateModal() {
        document.getElementById('modalTitle').innerText = 'Thêm Sản Phẩm';
        document.getElementById('productId').value = '';
        document.getElementById('productName').value = '';
        document.getElementById('productDesc').value = '';
        document.getElementById('productType').value = '';
        productModal.show();
    }

    function showEditModal(id, name, desc, typeId) {
        document.getElementById('modalTitle').innerText = 'Sửa Sản Phẩm';
        document.getElementById('productId').value = id;
        document.getElementById('productName').value = name;
        document.getElementById('productDesc').value = desc === 'null' ? '' : desc;
        document.getElementById('productType').value = typeId;
        productModal.show();
    }

    function saveProduct() {
        const id = document.getElementById('productId').value;
        const name = document.getElementById('productName').value.trim();
        const desc = document.getElementById('productDesc').value.trim();
        const typeId = document.getElementById('productType').value;

        if (!name || !typeId) {
            showNotification('Vui lòng nhập đầy đủ tên và chọn loại sản phẩm!', 'warning');
            return;
        }

        const url = id ? `${API_PRODUCTS_URL}/${id}` : API_PRODUCTS_URL;
        const method = id ? 'PUT' : 'POST';

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ 
                Name: name,
                Description: desc,
                FK_ProdType: typeId
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.EC === 0) {
                showNotification(data.EM, 'success');
                productModal.hide();
                loadProducts();
            } else {
                showNotification('Lỗi: ' + (data.EM || 'Có lỗi xảy ra'), 'danger');
            }
        })
        .catch(err => showNotification('Lỗi kết nối Server!', 'danger'));
    }

    function deleteProduct(id) {
        if (!confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) return;

        fetch(`${API_PRODUCTS_URL}/${id}`, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.EC === 0) {
                showNotification(data.EM, 'success');
                loadProducts();
            } else {
                showNotification('Lỗi: ' + (data.EM || 'Không thể xóa'), 'danger');
            }
        })
        .catch(err => showNotification('Lỗi kết nối Server!', 'danger'));
    }
</script>
</body>
</html>
