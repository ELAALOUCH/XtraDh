import { test, expect } from '@playwright/test';

test('AuthentificationCorrecte', async ({ page }) => {
  await page.goto('http://localhost:8080/');
  // on vérfie l'existence du formulaire d'ab
  const elementCount = await page.locator('div').filter({ hasText: 'Email AddressPasswordInfo Forgot Password ? Log In © 2023 UAE - All Rights Reser' }).nth(3).count();
  await expect(elementCount).toBeGreaterThan(0);

  const checkimg = await page.locator('img').first();
  await expect(checkimg).toBeVisible();

  const checkemail = await page.getByText('Email Address');
  await expect(checkemail).toBeVisible();
  const checkpwd = await page.getByText('Password', { exact: true });
  await expect(checkpwd).toBeVisible();
  const checkform = await page.getByText('Email AddressPasswordInfo Forgot Password ? Log In');
  await expect(checkform).toBeVisible();

  const checkfoot = await page.getByText('© 2023 UAE - All Rights Reserved.');
  await expect(checkfoot).toBeVisible();

  const checkem = await page.getByPlaceholder('Enter Email Address');
  await expect(checkem).toBeVisible();
  await page.getByPlaceholder('Enter Email Address').fill('tahaamine2002@gmail.com');

  await page.getByPlaceholder('Enter Password').press('Tab');
  await expect(checkfoot).toBeVisible();

  await page.getByPlaceholder('Enter Password').fill('test');
  
  const checklogin = await page.getByRole('button', { name: 'Log In' });
  await expect(checklogin).toBeVisible();

  await page.getByRole('button', { name: 'Log In' }).click();
// On check si la connexion est bien passé en fsant un check sur le bouton de déco s'il existe 
  const checkdeco = await page.getByText('Déconnexion');
  await expect(checkdeco).toBeVisible();
  await page.getByText('Déconnexion').click();
  
});

test('AuthentificationIncorrecte', async ({ page }) => {
  await page.goto('http://localhost:8080/');
  // on vérfie l'existence du formulaire d'ab
  const elementCount = await page.locator('div').filter({ hasText: 'Email AddressPasswordInfo Forgot Password ? Log In © 2023 UAE - All Rights Reser' }).nth(3).count();
  await expect(elementCount).toBeGreaterThan(0);

  const checkimg = await page.locator('img').first();
  await expect(checkimg).toBeVisible();

  const checkemail = await page.getByText('Email Address');
  await expect(checkemail).toBeVisible();
  const checkpwd = await page.getByText('Password', { exact: true });
  await expect(checkpwd).toBeVisible();
  const checkform = await page.getByText('Email AddressPasswordInfo Forgot Password ? Log In');
  await expect(checkform).toBeVisible();

  const checkfoot = await page.getByText('© 2023 UAE - All Rights Reserved.');
  await expect(checkfoot).toBeVisible();

  const checkem = await page.getByPlaceholder('Enter Email Address');
  await expect(checkem).toBeVisible();
  await page.getByPlaceholder('Enter Email Address').fill('testtest666@gmail.com');

  await page.getByPlaceholder('Enter Password').press('Tab');
  await expect(checkfoot).toBeVisible();

  await page.getByPlaceholder('Enter Password').fill('test');
  
  const checklogin = await page.getByRole('button', { name: 'Log In' });
  await expect(checklogin).toBeVisible();

  await page.getByRole('button', { name: 'Log In' }).click();
// On check si la connexion ne passe pas est qu'on est redirigés avec une alerte indiquant une erreur + même page d'accueil!! 
const checkerr = await page.getByText('InfoInvalid username or password');
await expect(checkerr).toBeVisible();

const checkalert = await page.getByRole('alert').locator('svg');
await expect(checkalert).toBeVisible();

const checktxt = await page.getByText('Invalid username or password');
await expect(checktxt).toBeVisible();

await expect(page).toHaveURL('http://localhost:8080/');
});