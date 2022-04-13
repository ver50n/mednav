@php
  $default = 'MedNav Management';
  $title = isset($title) ? $title : $default;
  $title .= ' - Medical Navigation';
@endphp
<title>{{ $title }}</title>