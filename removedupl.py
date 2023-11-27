import pandas as pd

def remove_duplicates(input_csv_file, output_csv_file):
    df = pd.read_csv(input_csv_file)
    df.drop_duplicates(inplace=True)

    df.to_csv(output_csv_file, index=False, encoding='utf-8')

if __name__ == "__main__":
    input_csv_file = r"C:\xampp\htdocs\python\resultado.csv"
    output_csv_file = r"C:\xampp\htdocs\python\resultadosemduplicata.csv"

    remove_duplicates(input_csv_file, output_csv_file)

    print(f"Duplicates removed and saved to {output_csv_file}")
