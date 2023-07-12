<?php

$config['staffattendance'] = array(
    'present' => 1,
    'half_day' => 4,
    'late' => 2,
    'absent' => 3,
    'holiday' => 5
);

$config['contracttype'] = array(
    'permanent' => 'Permanent',
    'probation' => 'Probation',
);

$config['status'] = array(
    'approve' => 'Approuver',
    'disapprove' => 'Désapprouver',
    'pending' => 'En attente',
);

$config['file_type'] = array(
    'video' => 'Vidéo',
    'audio' => 'Audio',
    'document' => 'Document',
);

$config['marital_status'] = array(
    'Single' => 'Célibataire',
    'Married' => 'Marié(e)',
    'Widowed' => 'Veuf(ve)',
    'Seperated' => 'Divorcé',
    'Not Specified' => 'Non précisé',
);

$config['payroll_status'] = array(
    'generated' => 'Généré',
    'paid' => 'Payé',
    'unpaid' => 'Non payé',
    'not_generate' => 'Not Generated',
);
$config['payment_mode'] = array(
    'cash' => 'Cash',
    'cheque' => 'Chèque',
    'online' => 'Virement sur un compte bancaire',
);
$config['enquiry_status'] = array(
    'active' => 'Active',
    'passive' => 'Passive',
    'dead' => 'Dead',
    'won' => 'Won',
    'lost' => 'Lost',
);
