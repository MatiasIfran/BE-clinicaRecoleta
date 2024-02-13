def encontrar_caracter_problematico(archivo_entrada, posicion_error):
    # Abrir el archivo de entrada y leer su contenido
    with open(archivo_entrada, 'rb') as f:
        # Mover el puntero a la posición especificada
        f.seek(posicion_error)

        # Leer una cantidad determinada de bytes alrededor de la posición del error
        contenido_around_error = f.read(40).decode('utf-8', 'replace')
        print(f"Contenido alrededor del error en la posición {posicion_error}: {contenido_around_error}")

# Ajusta el nombre del archivo y la posición del error
archivo_entrada = './sql/Pacientes.sql'
posicion_error = 583

encontrar_caracter_problematico(archivo_entrada, posicion_error)
