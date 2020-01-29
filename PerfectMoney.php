<?php
class PerfectMoney {
	public $settings = array(
		'description' => 'Accept payments via Perfect Money.',
	);
	function payment_features() {
		return '<img src="data:image/png;base64,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">';	
	}
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
