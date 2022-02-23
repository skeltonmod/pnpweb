def set_month_name(mnth):
	new_month = ""
	if mnth == 'Jan' or mnth == 'jan' or mnth == 'JAN' or mnth == 'January' or mnth == 'JANUARY' or mnth == 'january' or mnth == 'jan.' or mnth == 'Jan.' or mnth == 'JAN.':
		new_month = 'January'
	elif mnth == 'Feb' or mnth == 'feb' or mnth == 'FEB' or mnth == 'February' or mnth == 'FEBRUARY' or mnth == 'february' or mnth == 'feb.' or mnth == 'Feb.' or mnth == 'FEB.':
		new_month = 'February'
	elif mnth == 'Mar' or mnth == 'mar' or mnth == 'MAR' or mnth == 'March' or mnth == 'MARCH' or mnth == 'march' or mnth == 'mar.' or mnth == 'Mar.' or mnth == 'MAR.':
		new_month = 'March'
	elif mnth == 'Apr' or mnth == 'apr' or mnth == 'APR' or mnth == 'April' or mnth == 'APRIL' or mnth == 'april' or mnth == 'apr.' or mnth == 'Apr.' or mnth == 'APR.':
		new_month = 'April'
	elif mnth == 'May' or mnth == 'may' or mnth == 'MAY':
		new_month = 'May'
	elif mnth == 'Jun' or mnth == 'jun' or mnth == 'JUN' or mnth == 'June' or mnth == 'JUNE' or mnth == 'june' or mnth == 'jun.' or mnth == 'Jun.' or mnth == 'JUN.':
		new_month = 'June'
	elif mnth == 'Jul' or mnth == 'jul' or mnth == 'JUL' or mnth == 'July' or mnth == 'JULY' or mnth == 'july' or mnth == 'jul.' or mnth == 'Jul.' or mnth == 'JUL.':
		new_month = 'July'
	elif mnth == 'Aug' or mnth == 'aug' or mnth == 'AUG' or mnth == 'August' or mnth == 'AUGUST' or mnth == 'august' or mnth == 'aug.' or mnth == 'Aug.' or mnth == 'AUG.':
		new_month = 'August'
	elif mnth == 'Sep' or mnth == 'sep' or mnth == 'SEP' or mnth == 'September' or mnth == 'SEPTEMBER' or mnth == 'september' or mnth == 'sep.' or mnth == 'Sep.' or mnth == 'SEP.' or mnth == 'Sept.' or mnth == 'sept.' or mnth == 'Sept' or mnth == 'sept':
		new_month = 'September'
	elif mnth == 'Oct' or mnth == 'oct' or mnth == 'OCT' or mnth == 'October' or mnth == 'OCTOBER' or mnth == 'october' or mnth == 'oct.' or mnth == 'Oct.' or mnth == 'OCT.' or mnth == 'Oct':
		new_month = 'October'
	elif mnth == 'Nov' or mnth == 'nov' or mnth == 'NOV' or mnth == 'November' or mnth == 'NOVEMBER' or mnth == 'november' or mnth == 'nov.' or mnth == 'Nov.' or mnth == 'NOV.':
		new_month = 'November'
	elif mnth == 'Dec' or mnth == 'dec' or mnth == 'DEC' or mnth == 'December' or mnth == 'DECEMBER' or mnth == 'december' or mnth == 'dec.' or mnth == 'Dec.' or mnth == 'DEC.':
		new_month = 'December'
	return new_month

def monthNumber_to_monthName(num):
	monthName = ''
	if num == 1 or str(num) == '01' or str(num) == '1':
		monthName = 'January'
	if num == 2 or str(num) == '02' or str(num) == '2':
		monthName = 'February'
	if num == 3 or str(num) == '03' or str(num) == '3':
		monthName = 'March'
	if num == 4 or str(num) == '04' or str(num) == '4':
		monthName = 'April'
	if num == 5 or str(num) == '05' or str(num) == '5':
		monthName = 'May'
	if num == 6 or str(num) == '06' or str(num) == '6':
		monthName = 'June'
	if num == 7 or str(num) == '07' or str(num) == '7':
		monthName = 'July'
	if num == 8 or str(num) == '08' or str(num) == '8':
		monthName = 'August'
	if num == 9 or str(num) == '09' or str(num) == '9':
		monthName = 'September'
	if num == 10 or str(num) == '10':
		monthName = 'October'
	if num == 11 or str(num) == '11':
		monthName = 'November'
	if num == 12 or str(num) == '12':
		monthName = 'December'
	return monthName

def isThere_period(txt):
	new_txt = txt.find(".")
	val = False
	if new_txt < 0:
		val = False
	else:
		val = True
	return val
