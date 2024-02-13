import re
import random

contador = 1000000

def modificar_sql(archivo_entrada, archivo_salida):
    # Abrir el archivo de entrada y leer su contenido
    with open(archivo_entrada, 'r') as f:
        sql_contenido = f.read()

    filas_sql = re.split(r'\),\s*\(', sql_contenido)

    # Realizar modificaciones en el contenido SQL
    sql_modificado = ""
    for i, fila in enumerate(filas_sql):
        fila_modificada = modificar_contenido(fila)

        # Agregar punto y coma después de cada 'filas_por_punto_y_coma' filas
        if (i + 1) % 1000 == 0 and i != len(filas_sql) - 1:
            sql_modificado += ";\n\n INSERT INTO `pacientes` (`id`, `nombre`, `Direccion`, `codpos`, `NumDocumento`, `Telefono`, `Celular`, `FechaNacimiento`, `FechaIngreso`, `FechaCarga`, `NumAfiliado`, `empres`, `iva`, `cuit`, `MedCabecera`, `TipoDocumento`, `detaplan`, `plan`, `Antecedentes`, `modulo`, `mail`, `hc`, `Genero`, `created_at`, `updated_at`, `usuario`) VALUES\n"
        elif i == len(filas_sql) - 1:  # Si es la última fila
            sql_modificado += ";\n"
        else:
            sql_modificado += f"({fila_modificada}),\n"

    # Escribir el contenido modificado en el archivo de salida
    with open(archivo_salida, 'w') as f:
        f.write(sql_modificado[:-1])

def modificar_contenido(sql_contenido):
    global contador  # Declarar el contador como global

    # Reemplazar valores específicos en el campo TipoDocumento
    sql_modificado = re.sub(r"'DNI'", '1', sql_contenido)
    sql_modificado = re.sub(r"'LC'", '2', sql_modificado)
    sql_modificado = re.sub(r"'LE'", '3', sql_modificado)

    # Elimino columnas
    sql_modificado = eliminar_columna_en_posicion(sql_modificado, 4) #dirpart
    sql_modificado = eliminar_columna_en_posicion(sql_modificado, 4) #zona
    sql_modificado = eliminar_columna_en_posicion(sql_modificado, 8) #edad
    sql_modificado = eliminar_columna_en_posicion(sql_modificado, 10) #observ
    sql_modificado = eliminar_columna_en_posicion(sql_modificado, 10) #prexist
    sql_modificado = eliminar_columna_en_posicion(sql_modificado, 17) #plan2
    sql_modificado = eliminar_columna_en_posicion(sql_modificado, 19) #cabecera

    # utilizado para el insert
    sql_modificado = re.sub(r'`dirpart`\s*,\s*', '', sql_modificado)
    sql_modificado = re.sub(r'`zona`\s*,\s*', '', sql_modificado)
    sql_modificado = re.sub(r'`edad`\s*,\s*', '', sql_modificado)
    sql_modificado = re.sub(r'`observ`\s*,\s*', '', sql_modificado)
    sql_modificado = re.sub(r'`prexist`\s*,\s*', '', sql_modificado)
    sql_modificado = re.sub(r'`cabecera`\s*,\s*', '', sql_modificado)
    sql_modificado = re.sub(r'`plan2`\s*,\s*', '', sql_modificado)

    #Modificar columnas
    sql_modificado = re.sub(r'`grupo`', '`id`', sql_modificado)
    sql_modificado = re.sub(r'`dircob`', '`Direccion`', sql_modificado)
    sql_modificado = re.sub(r'`doc`', '`NumDocumento`', sql_modificado)
    sql_modificado = re.sub(r'`tele`', '`Telefono`', sql_modificado)
    sql_modificado = re.sub(r'`whats`', '`Celular`', sql_modificado)
    sql_modificado = re.sub(r'`fnac`', '`FechaNacimiento`', sql_modificado)
    sql_modificado = re.sub(r'`fing`', '`FechaIngreso`', sql_modificado)
    sql_modificado = re.sub(r'`fcar`', '`FechaCarga`', sql_modificado)
    sql_modificado = re.sub(r'`nroafi`', '`NumAfiliado`', sql_modificado)
    sql_modificado = re.sub(r'`medico`', '`MedCabecera`', sql_modificado)
    sql_modificado = re.sub(r'`tipdoc`', '`TipoDocumento`', sql_modificado)
    sql_modificado = re.sub(r'`antece`', '`Antecedentes`', sql_modificado)
    sql_modificado = re.sub(r'`sexo`', '`Genero`', sql_modificado)
    sql_modificado = re.sub(r'`created`', '`created_at`', sql_modificado)
    sql_modificado = re.sub(r'`modified`', '`updated_at`', sql_modificado)

    # Verificar si la columna número 5 es nula o 0 y generar un número aleatorio de 7 dígitos
    if re.search(r'\b(0|null|NULL)\b', sql_modificado.split(',')[4]):
        num_aleatorio = format(contador, '07d')
        contador += 1        
        # Reemplazar la columna número 5 con el número aleatorio generado
        sql_modificado = re.sub(r'(\b(0|null|NULL)\b)', num_aleatorio, sql_modificado, count=1)
    
    # Reemplazar comas por espacios en la tercera columna
    sql_modificado = re.sub(r'(\'[^\',]+),([^\']+\')', r'\1 \2', sql_modificado)
  
    return sql_modificado

def eliminar_columna_en_posicion(sql, posicion):
    # Dividir la sentencia SQL en partes
    columnas = sql.split(",")

    # Eliminar el elemento en la posición especificada
    del columnas[posicion]

    # Volver a unir las partes en una nueva sentencia SQL
    sql_limpio = ','.join(columnas)

    return sql_limpio

# Uso del script
archivo_entrada = './sql/archivo_entrada.sql'
archivo_salida = './sql/archivo_salida.sql'
modificar_sql(archivo_entrada, archivo_salida)
