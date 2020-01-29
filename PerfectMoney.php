<?php
class PerfectMoney {
	public $settings = array(
		'description' => 'Accept payments via Perfect Money.',
	);
	function payment_button($params) {
		global $billic, $db;
		$html = '';
		if (get_config('perfectmoney_account_eur') == '' && get_config('perfectmoney_account_usd') == '') {
			return $html;
		}
		if ($billic->user['verified'] == 0 && get_config('perfectmoney_require_verification') == 1) {
			return 'verify';
		} else {
			if (get_config('perfectmoney_account_usd') != '') {
				$amount_USD = round($billic->currency_convert(array(
					'currency_from' => get_config('billic_currency_code') ,
					'currency_to' => 'USD',
					'amount' => $params['charge'],
				)) , 2);
				$html.= '<form action="https://perfectmoney.is/api/step1.asp" method="POST" class="pm-form-USD">' . PHP_EOL;
				$html.= '<input type="hidden" name="PAYEE_ACCOUNT" value="' . get_config('perfectmoney_account_usd') . '">' . PHP_EOL;
				$html.= '<input type="hidden" name="PAYEE_NAME" value="' . get_config('billic_companyname') . '">' . PHP_EOL;
				$html.= '<input type="hidden" name="PAYMENT_ID" value="' . $params['invoice']['id'] . '">' . PHP_EOL;
				$html.= '<input type="hidden" name="PAYMENT_AMOUNT" value="' . $amount_USD . '">' . PHP_EOL;
				$html.= '<input type="hidden" name="PAYMENT_UNITS" value="USD">' . PHP_EOL;
				$html.= '<input type="hidden" name="STATUS_URL" value="http' . (get_config('billic_ssl') == 1 ? 's' : '') . '://' . get_config('billic_domain') . '/Gateway/PerfectMoney/">' . PHP_EOL;
				$html.= '<input type="hidden" name="PAYMENT_URL" value="http' . (get_config('billic_ssl') == 1 ? 's' : '') . '://' . get_config('billic_domain') . '/User/Invoices/ID/' . $params['invoice']['id'] . '/Status/Complete/">' . PHP_EOL;
				$html.= '<input type="hidden" name="PAYMENT_URL_METHOD" value="GET">' . PHP_EOL;
				$html.= '<input type="hidden" name="NOPAYMENT_URL" value="http' . (get_config('billic_ssl') == 1 ? 's' : '') . '://' . get_config('billic_domain') . '/User/Invoices/ID/' . $params['invoice']['id'] . '/">' . PHP_EOL;
				$html.= '<input type="hidden" name="NOPAYMENT_URL_METHOD" value="GET">' . PHP_EOL;
				$html.= '<input type="hidden" name="SUGGESTED_MEMO" value="">' . PHP_EOL;
				$html.= '<input type="hidden" name="BAGGAGE_FIELDS" value="">' . PHP_EOL;
				$html.= '<input type="submit" class="btn btn-default" name="PAYMENT_METHOD" value="Perfect Money (USD)">' . PHP_EOL;
				$html.= '</form>' . PHP_EOL;
				$html.= '<style>.pm-form-USD {float:left}</style>'.PHP_EOL;
			}
			if (get_config('perfectmoney_account_eur') != '') {
				$amount_EUR = round($billic->currency_convert(array(
					'currency_from' => get_config('billic_currency_code') ,
					'currency_to' => 'EUR',
					'amount' => $params['charge'],
				)) , 2);
				$html.= '<form action="https://perfectmoney.is/api/step1.asp" method="POST" class="pm-form-EUR">' . PHP_EOL;
				$html.= '<input type="hidden" name="PAYEE_ACCOUNT" value="' . get_config('perfectmoney_account_eur') . '">' . PHP_EOL;
				$html.= '<input type="hidden" name="PAYEE_NAME" value="' . get_config('billic_companyname') . '">' . PHP_EOL;
				$html.= '<input type="hidden" name="PAYMENT_ID" value="' . $params['invoice']['id'] . '">' . PHP_EOL;
				$html.= '<input type="hidden" name="PAYMENT_AMOUNT" value="' . $amount_EUR . '">' . PHP_EOL;
				$html.= '<input type="hidden" name="PAYMENT_UNITS" value="EUR">' . PHP_EOL;
				$html.= '<input type="hidden" name="STATUS_URL" value="http' . (get_config('billic_ssl') == 1 ? 's' : '') . '://' . get_config('billic_domain') . '/Gateway/PerfectMoney/">' . PHP_EOL;
				$html.= '<input type="hidden" name="PAYMENT_URL" value="http' . (get_config('billic_ssl') == 1 ? 's' : '') . '://' . get_config('billic_domain') . '/User/Invoices/ID/' . $params['invoice']['id'] . '/Status/Complete/">' . PHP_EOL;
				$html.= '<input type="hidden" name="PAYMENT_URL_METHOD" value="GET">' . PHP_EOL;
				$html.= '<input type="hidden" name="NOPAYMENT_URL" value="http' . (get_config('billic_ssl') == 1 ? 's' : '') . '://' . get_config('billic_domain') . '/User/Invoices/ID/' . $params['invoice']['id'] . '/">' . PHP_EOL;
				$html.= '<input type="hidden" name="NOPAYMENT_URL_METHOD" value="GET">' . PHP_EOL;
				$html.= '<input type="hidden" name="SUGGESTED_MEMO" value="">' . PHP_EOL;
				$html.= '<input type="hidden" name="BAGGAGE_FIELDS" value="">' . PHP_EOL;
				$html.= '<input type="submit" class="btn btn-default" name="PAYMENT_METHOD" value="Perfect Money (EUR)">' . PHP_EOL;
				$html.= '</form>' . PHP_EOL;
				$html.= '<style>.pm-form-EUR {float:left;padding-left: 20px}</style>'.PHP_EOL;
			}
			//$html .= '<div style="clear:both"></div>';
			
		}
		return $html;
	}
	function payment_callback() {
		global $billic, $db;
		$string = $_POST['PAYMENT_ID'] . ':' . $_POST['PAYEE_ACCOUNT'] . ':' . $_POST['PAYMENT_AMOUNT'] . ':' . $_POST['PAYMENT_UNITS'] . ':' . $_POST['PAYMENT_BATCH_NUM'] . ':' . $_POST['PAYER_ACCOUNT'] . ':' . strtoupper(md5(get_config('perfectmoney_secret'))) . ':' . $_POST['TIMESTAMPGMT'];
		$hash = strtoupper(md5($string));
		if ($hash == $_POST['V2_HASH'] && ($_POST['PAYEE_ACCOUNT'] == get_config('perfectmoney_account_eur') || $_POST['PAYEE_ACCOUNT'] == get_config('perfectmoney_account_usd'))) {
			$billic->module('Invoices');
			return $billic->modules['Invoices']->addpayment(array(
				'gateway' => 'PerfectMoney',
				'invoiceid' => $_POST['PAYMENT_ID'],
				'amount' => $_POST['PAYMENT_AMOUNT'],
				'currency' => $_POST['PAYMENT_UNITS'],
				'transactionid' => $_POST['PAYMENT_BATCH_NUM'],
			));
		} else {
			return 'invalid transaction hash';
		}
	}
	function settings($array) {
		global $billic, $db;
		if (empty($_POST['update'])) {
			echo '<form method="POST"><input type="hidden" name="billic_ajax_module" value="PerfectMoney"><table class="table table-striped">';
			echo '<tr><th>Setting</th><th>Value</th></tr>';
			echo '<tr><td>Require Verification</td><td><input type="checkbox" name="perfectmoney_require_verification" value="1"' . (get_config('perfectmoney_require_verification') == 1 ? ' checked' : '') . '></td></tr>';
			echo '<tr><td>PerfectMoney Account EUR</td><td><input type="text" class="form-control" name="perfectmoney_account_eur" value="' . safe(get_config('perfectmoney_account_eur')) . '"></td></tr>';
			echo '<tr><td>PerfectMoney Account USD</td><td><input type="text" class="form-control" name="perfectmoney_account_usd" value="' . safe(get_config('perfectmoney_account_usd')) . '"></td></tr>';
			echo '<tr><td>PerfectMoney Secret</td><td><input type="text" class="form-control" name="perfectmoney_secret" value="' . safe(get_config('perfectmoney_secret')) . '"></td></tr>';
			echo '<tr><td colspan="2" align="center"><input type="submit" class="btn btn-default" name="update" value="Update &raquo;"></td></tr>';
			echo '</table></form>';
		} else {
			if (empty($billic->errors)) {
				set_config('perfectmoney_require_verification', $_POST['perfectmoney_require_verification']);
				set_config('perfectmoney_account_eur', $_POST['perfectmoney_account_eur']);
				set_config('perfectmoney_account_usd', $_POST['perfectmoney_account_usd']);
				set_config('perfectmoney_secret', $_POST['perfectmoney_secret']);
				$billic->status = 'updated';
			}
		}
	}
}
