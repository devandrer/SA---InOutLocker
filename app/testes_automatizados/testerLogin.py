from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
import time

options = webdriver.ChromeOptions()
driver = webdriver.Chrome(options=options)

#executara o projeto na tela inicial do login
driver.get("http://localhost:8080/inoutlocker/app/index.php")

time.sleep(4)

#preenche o campo login com o e-mail já cadastrado
email_input = driver.find_element(By.NAME, "nNome") 
email_input.send_keys("j@teste.com")


#preenche o campo senha já cadastrada
senha_input = driver.find_element(By.NAME, "nSenha")
senha_input.send_keys("123")

#vai acessar o sistema
submit_button = driver.find_element(By.CSS_SELECTOR, "button[type='submit']")
submit_button.click()

#vai aguardar o resultado por 8 seg.
time.sleep(8)

#fecha o navegador
driver.quit()
