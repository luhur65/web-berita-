# Latihan 11
# Game Tebak Angka Ala Python
# By : Dharma Situmorang
import random
# Atribut Pemanis
samaDengan = '='.center(80, '=')
garis = '_'.center(80, '_')
pembuka = ' Welcome To My GamesFun '.center(80)
# Input Nama Pemain Terlebih Dahulu
print(samaDengan)
print(pembuka.upper())
print(samaDengan)
print('Enter Your Name :')
nama = input()
print('\n')
print('Selamat Bermain !!!')
print(nama.upper())
print('='.center(24,'='))
# Acak Looping
data = random.randint(1,10) # Integer Dari 1 - 10 tipe datanya integer
nomor_acak = str(data)

# Argument Ingin Bermain Lagi Atau Tidak ??
true = 'yes'    # Jika Ingin Lanjut Permainan Ketika Sudah Tepat Menebak
false = 'no'    # Tidak Lanjut Permainan Game Berhenti
null = ''       # Jika Tidak Menjawab Yes Atau NO
print(nomor_acak)
print('Coba Tebak Angka Favorit Saya Dari ( 1 - 10) ')
while True:
    print('Tebakan Anda :')
    tebakan = input()       # inputan User
    # Kesempatan 1
    if tebakan.isalpha():
        print('Masukkan Hanya Angka Saja \n')
    else:
        if tebakan != nomor_acak:
            print('Tebakan Anda Salah')
            print('Ayo Tebak Lagi ?? \n')
        elif tebakan == nomor_acak:
            print('_'.center(80,'_'))
            print('Selamat !!! Tebakan Anda Benar'.center(80))
            print('Game Telah Selesai'.center(80))
            print('_'.center(80,'_'))
            print('You Wanna Play Again ?? %s' % nama)
            print('Pilih Salah Satu :')
            print('yes')
            print('no')
            answer = input()
            if answer == false:
                print('Thank You For Playing , See You \n')
                break
            elif answer == null:
                print('\n')
                print('Anda Belum Menjawab Pertanyaan Yg Diberikan')
                print('Harap Masukkan Opsi ( ya  ) atau ( no )')
                print('Angka Yg Berhasil Anda Tebak : %s' % nomor_acak)
                print('Tulis Kembali Angka Yg Anda Tebak Dibawah Ini \n')
            elif answer == true:
                data = random.randint(1,10) # Boleh Diisi Bebas Dari 1 - 10 tipe datanya string bukan integer
                nomor_acak = str(data)
                print(nomor_acak)
                print('\n')
                print('Selamat Bermain Kembali!!!')
                print(nama.upper())
                print('='.center(24,'='))
                print('Coba Tebak Angka Favorit Saya Dari ( 1 - 10) ')
            else:
                print('\n')
                print('Opsi yg Anda Pilih Tidak Ada')
                print('Harap Masukkan Opsi ( ya  ) atau ( no )')
                print('Angka Yg Berhasil Anda Tebak : %s' % nomor_acak)
                print('Tulis Kembali Angka Yg Anda Tebak Dibawah Ini \n')
                
                while False:
                    print('Tebakan Anda :')
                    tebakan = input()
                    # Kesempatan 2
                    if tebakan.isalpha():
                        print('Masukkan Hanya Angka Saja \n')
                    else:
                        if tebakan != nomor_acak:
                            print('Tebakan Anda Salah')
                            print('Ayo Tebak Lagi ?? \n')
                        elif tebakan == nomor_acak:
                            print('_'.center(80,'_'))
                            print('Selamat !!! Tebakan Anda Benar'.center(80))
                            print('Game Telah Selesai'.center(80))
                            print('_'.center(80,'_'))
                            print('You Wanna Play Again ?? %s' % nama)
                            print('Pilih Salah Satu :')
                            print('yes')
                            print('no')
                            answer = input()
                
# This My First Exercice to Make
# SimpleGame
# guessing the number between 1 - 10
# Thank You 
                
            

       
    
