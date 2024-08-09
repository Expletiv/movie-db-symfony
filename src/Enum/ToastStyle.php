<?php

namespace App\Enum;

enum ToastStyle: string
{
    case PRIMARY = 'primary';
    case SUCCESS = 'success';
    case INFO = 'info';
    case WARNING = 'warning';
    case DANGER = 'danger';
}
