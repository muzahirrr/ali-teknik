function currencyFormatter(value) {
  return Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR',
      maximumSignificantDigits: Math.trunc(Math.abs(value)).toFixed().length,
  }).format(value);
}