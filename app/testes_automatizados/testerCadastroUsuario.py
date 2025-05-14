from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
import time

options = webdriver.ChromeOptions()
driver = webdriver.Chrome(options=options)

#executara o projeto na tela inicial do login
driver.get("http://localhost:8080/inoutlocker/app/usuarios.php")

time.sleep(4)

#vai acessar o sistema
novousuario_button = driver.find_element(By.ID,"novousuario")
novousuario_button.click()

# Preenche o campo Nome
nome_input = driver.find_element(By.NAME, "nNome")
nome_input.send_keys("João da Silva")

# Preenche o campo CPF
cpf_input = driver.find_element(By.NAME, "nCpf")
cpf_input.send_keys("12345678912")

#preenche o campo tipo usuario
select_tipo = Select(driver.find_element(By.NAME, "nTipoUsuario"))
select_tipo.select_by_index(1)

select_empresa = Select(driver.find_element(By.NAME, "nEmpresa"))
select_empresa.select_by_index(1)

#preenche o campo login com o e-mail
email_input = driver.find_element(By.NAME, "nLogin") 
email_input.send_keys("jo@teste.com")

#preenche o campo senha
senha_input = driver.find_element(By.NAME, "nSenha")
senha_input.send_keys("123")

# Preenche o campo matricula
matricula_input = driver.find_element(By.NAME, "nMatricula")
matricula_input.send_keys("205206")

# Preenche o campo usuario ativo
ativo_checkbox = driver.find_element(By.NAME, "nAtivo")
ativo_checkbox.click()

# Preenche o campo cep
cep_input = driver.find_element(By.NAME, "CEP")
cep_input.send_keys("89231-300")

# Preenche o campo numero do endereco
numero_input = driver.find_element(By.NAME, "Numero")
numero_input.send_keys("789")

#vai acessar o sistema
submit_button = driver.find_element(By.CSS_SELECTOR, "button[type='submit']")
submit_button.click()

#vai aguardar o resultado por 8 seg.
time.sleep(8)

#fecha o navegador
driver.quit()
