import { test, expect } from '@playwright/test';

test('RecupCorrecte', async ({ page }) => {
  await page.goto('http://localhost:8080/');
  // on vérfie l'existence du formulaire d'ab
  const elementCount = await page.locator('div').filter({ hasText: 'Email AddressPasswordInfo Forgot Password ? Log In © 2023 UAE - All Rights Reser' }).nth(3).count();
  await expect(elementCount).toBeGreaterThan(0);

  const checkforg = await page.getByRole('link', { name: 'Forgot Password ?' });
  await expect(checkforg).toBeVisible();

  await page.getByRole('link', { name: 'Forgot Password ?' }).click();

  const checktitre = await page.getByText('Forgot PasswordEmailEmail Me a link');
  await expect(checktitre).toBeVisible();

  const checkfpwd = await page.getByRole('heading', { name: 'Forgot Password' });
  await expect(checkfpwd).toBeVisible();

  const checkem= await page.getByText('Email', { exact: true });
  await expect(checkem).toBeVisible();

  const checkeml = await page.getByRole('button', { name: 'Email Me a link' });
  await expect(checkeml).toBeVisible();
  
  const checkemail = await page.getByLabel('Email');
  await expect(checkemail).toBeVisible();

  await page.getByLabel('Email').fill('tahaamine2002@gmail.com');

  await page.getByRole('button', { name: 'Email Me a link' }).click();

  await expect(page).toHaveURL('http://localhost:8080/Forgetpassword');

  const extendedTimeout = 10000; // 10 secondes

  await page.waitForTimeout(extendedTimeout);

  const checkwait = await page.getByText('Wait Please an email will be sent, check your email Back to login');
  await expect(checkwait).toBeVisible();

  await page.waitForTimeout(extendedTimeout);
  const checkwait2 = await page.getByRole('heading', { name: 'Wait Please an email will be sent, check your email' });
  await expect(checkwait2).toBeVisible();

  const checkback = await page.getByRole('button', { name: 'Back to login' });
  await expect(checkback).toBeVisible();

  await page.getByRole('button', { name: 'Back to login' }).click();

  await expect(page).toHaveURL('http://localhost:8080/');

});

test('RecupIncorrecte', async ({ page }) => {
    await page.goto('http://localhost:8080/');
    // on vérfie l'existence du formulaire d'ab
    const elementCount = await page.locator('div').filter({ hasText: 'Email AddressPasswordInfo Forgot Password ? Log In © 2023 UAE - All Rights Reser' }).nth(3).count();
    await expect(elementCount).toBeGreaterThan(0);
  
    const checkforg = await page.getByRole('link', { name: 'Forgot Password ?' });
    await expect(checkforg).toBeVisible();
  
    await page.getByRole('link', { name: 'Forgot Password ?' }).click();
  
    const checktitre = await page.getByText('Forgot PasswordEmailEmail Me a link');
    await expect(checktitre).toBeVisible();
  
    const checkfpwd = await page.getByRole('heading', { name: 'Forgot Password' });
    await expect(checkfpwd).toBeVisible();
  
    const checkem= await page.getByText('Email', { exact: true });
    await expect(checkem).toBeVisible();
  
    const checkeml = await page.getByRole('button', { name: 'Email Me a link' });
    await expect(checkeml).toBeVisible();
    
    const checkemail = await page.getByLabel('Email');
    await expect(checkemail).toBeVisible();
  
    await page.getByLabel('Email').fill('testtest@example.com');
  
    await page.getByRole('button', { name: 'Email Me a link' }).click();
  
    await expect(page).toHaveURL('http://localhost:8080/Forgetpassword');
  
    const checkalt = await page.getByRole('alert');
    await expect(checkalt).toBeVisible();
  
    const checkfail = await page.getByText('User doesn\'t exists');
    await expect(checkfail).toBeVisible();
  
  
  });