<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-address-book text-primary mr-3"></i>
                        Supplier Contacts
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory"><?php echo lang('inventory'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory/reports"><?php echo lang('reports'); ?></a></li>
                            <li class="breadcrumb-item active">Supplier Contacts</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="inventory/reports" class="btn btn-secondary btn-sm px-4">
                        <i class="fa fa-arrow-left"></i> Back to Reports
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <!-- Supplier Contacts -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-address-book mr-2"></i>
                                Supplier Contact Directory
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="contactsTable">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="font-weight-bold">Supplier Name</th>
                                            <th class="font-weight-bold">Company</th>
                                            <th class="font-weight-bold">Contact Person</th>
                                            <th class="font-weight-bold">Email</th>
                                            <th class="font-weight-bold">Phone</th>
                                            <th class="font-weight-bold">Address</th>
                                            <th class="font-weight-bold">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($contacts)) { ?>
                                            <?php foreach ($contacts as $contact) { ?>
                                                <tr>
                                                    <td class="font-weight-bold"><?php echo htmlspecialchars($contact->supplier_name); ?></td>
                                                    <td><?php echo htmlspecialchars($contact->company_name ?: '-'); ?></td>
                                                    <td>
                                                        <?php if ($contact->contact_person) { ?>
                                                            <i class="fas fa-user mr-1"></i>
                                                            <?php echo htmlspecialchars($contact->contact_person); ?>
                                                        <?php } else { ?>
                                                            <span class="text-muted">Not available</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($contact->email) { ?>
                                                            <a href="mailto:<?php echo $contact->email; ?>" class="text-primary">
                                                                <i class="fas fa-envelope mr-1"></i>
                                                                <?php echo htmlspecialchars($contact->email); ?>
                                                            </a>
                                                        <?php } else { ?>
                                                            <span class="text-muted">Not available</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($contact->phone) { ?>
                                                            <a href="tel:<?php echo $contact->phone; ?>" class="text-success">
                                                                <i class="fas fa-phone mr-1"></i>
                                                                <?php echo htmlspecialchars($contact->phone); ?>
                                                            </a>
                                                        <?php } else { ?>
                                                            <span class="text-muted">Not available</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($contact->address) { ?>
                                                            <small><?php echo htmlspecialchars($contact->address); ?></small>
                                                        <?php } else { ?>
                                                            <span class="text-muted">Not available</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <?php if ($contact->email) { ?>
                                                                <a href="mailto:<?php echo $contact->email; ?>" class="btn btn-sm btn-primary" title="Send Email">
                                                                    <i class="fas fa-envelope"></i>
                                                                </a>
                                                            <?php } ?>
                                                            <?php if ($contact->phone) { ?>
                                                                <a href="tel:<?php echo $contact->phone; ?>" class="btn btn-sm btn-success" title="Call">
                                                                    <i class="fas fa-phone"></i>
                                                                </a>
                                                            <?php } ?>
                                                            <button class="btn btn-sm btn-info" onclick="exportContact('<?php echo addslashes($contact->supplier_name); ?>', '<?php echo addslashes($contact->contact_person); ?>', '<?php echo addslashes($contact->email); ?>', '<?php echo addslashes($contact->phone); ?>')" title="Export to VCard">
                                                                <i class="fas fa-download"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="7" class="text-center text-muted py-4">
                                                    <i class="fas fa-address-book fa-3x mb-3"></i>
                                                    <br>No supplier contacts found.
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Summary Cards -->
            <?php if (!empty($contacts)) { ?>
            <div class="row mt-4">
                <div class="col-md-3">
                    <div class="card bg-primary text-white shadow-lg">
                        <div class="card-body text-center">
                            <i class="fas fa-building fa-3x mb-3"></i>
                            <h4><?php echo count($contacts); ?></h4>
                            <p class="mb-0">Total Suppliers</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white shadow-lg">
                        <div class="card-body text-center">
                            <i class="fas fa-envelope fa-3x mb-3"></i>
                            <h4><?php echo count(array_filter($contacts, function($c) { return !empty($c->email); })); ?></h4>
                            <p class="mb-0">With Email</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white shadow-lg">
                        <div class="card-body text-center">
                            <i class="fas fa-phone fa-3x mb-3"></i>
                            <h4><?php echo count(array_filter($contacts, function($c) { return !empty($c->phone); })); ?></h4>
                            <p class="mb-0">With Phone</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white shadow-lg">
                        <div class="card-body text-center">
                            <i class="fas fa-user fa-3x mb-3"></i>
                            <h4><?php echo count(array_filter($contacts, function($c) { return !empty($c->contact_person); })); ?></h4>
                            <p class="mb-0">With Contact Person</p>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>
</div>

<script>
$(document).ready(function() {
    $('#contactsTable').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"],
        "order": [[ 0, "asc" ]]
    }).buttons().container().appendTo('#contactsTable_wrapper .col-md-6:eq(0)');
});

function exportContact(supplierName, contactPerson, email, phone) {
    // Create VCard content
    var vCard = "BEGIN:VCARD\n";
    vCard += "VERSION:3.0\n";
    vCard += "FN:" + supplierName + "\n";
    if (contactPerson) {
        vCard += "N:" + contactPerson + ";;;;\n";
    }
    vCard += "ORG:" + supplierName + "\n";
    if (email) {
        vCard += "EMAIL:" + email + "\n";
    }
    if (phone) {
        vCard += "TEL:" + phone + "\n";
    }
    vCard += "END:VCARD";

    // Create download link
    var blob = new Blob([vCard], { type: 'text/vcard' });
    var url = window.URL.createObjectURL(blob);
    var a = document.createElement('a');
    a.href = url;
    a.download = supplierName.replace(/[^a-z0-9]/gi, '_').toLowerCase() + '.vcf';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
}
</script>