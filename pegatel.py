import phonenumbers
import openpyxl
import csv

def extract_phone_numbers(file_path):
    phone_numbers = []
    wb = openpyxl.load_workbook(file_path)
    sheet = wb.active

    for row in sheet.iter_rows(values_only=True):
        for cell in row:
            if cell is not None and isinstance(cell, str):
                numbers = phonenumbers.PhoneNumberMatcher(cell, "BR")
                for match in numbers:
                    phone_numbers.append(phonenumbers.format_number(match.number, phonenumbers.PhoneNumberFormat.E164))

    return phone_numbers

def save_to_csv(phone_numbers, output_file):
    with open(output_file, "w", newline="") as file:
        writer = csv.writer(file)
        for number in phone_numbers:
            writer.writerow([number])


xlsx_file = r"C:\xampp\htdocs\python\arquivos.xlsx.xlsx"
csv_file = "resultado.csv"

numbers = extract_phone_numbers(xlsx_file)
save_to_csv(numbers, csv_file)
