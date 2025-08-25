import os

# folder project
root_dir = "."

# daftar teks lama -> teks baru
old_new = {
    "SMK BOE Malang": "SMK Telkom Malang",
    "Alamat: Jl. Teluk Mandar Tromol Pos 5, 65126 Ajosari-Malang, Jawa Timur":
        "Alamat: Jl. Danau Ranau, Sawojajar, Kec. Kedungkandang, Kota Malang, Jawa Timur 65139",
    "Email: bbppmpvboe@kemdikbud.go.id":
        "Email: info@smktelkom-mlg.sch.id",
    "Email Pengaduan: pengaduanp4tkboe@kemdikbud.go.id":
        "Email: info@smktelkom-mlg.sch.id",
    "Telepon: (0341) 491239, 495849":
        "Telepon: 0812-2348-8999",
    "Fax: (0341) 491342":
        ""
}

# loop semua file di repo
for subdir, _, files in os.walk(root_dir):
    for file in files:
        if file.endswith((".html", ".php", ".js", ".md")):
            path = os.path.join(subdir, file)
            with open(path, "r", encoding="utf-8") as f:
                content = f.read()

            # lakukan penggantian
            for old, new in old_new.items():
                content = content.replace(old, new)

            # hapus email duplikat → simpan hanya 1x per alamat email
            lines = content.splitlines()
            seen_emails = set()
            new_lines = []
            for line in lines:
                if line.strip().lower().startswith("email:"):
                    # normalisasi biar sama persis
                    email_value = line.strip().lower()
                    if email_value not in seen_emails:
                        new_lines.append(line.strip())
                        seen_emails.add(email_value)
                    # kalau sudah pernah muncul → skip
                else:
                    new_lines.append(line)
            content = "\n".join(new_lines)

            with open(path, "w", encoding="utf-8") as f:
                f.write(content)

print("✅ Selesai! Semua informasi sudah diganti dan email duplikat dibersihkan.")
