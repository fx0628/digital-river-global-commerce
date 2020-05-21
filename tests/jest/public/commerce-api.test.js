import DRCommerceApi from '../../../assets/js/public/commerce-api';

describe('DRCommerceApi', () => {

  beforeEach(() => {
    $.ajax = jest.fn().mockImplementationOnce(() => {
      return Promise.resolve();
    });
  });
  const defaultHeaders = {
    Accept: 'application/json',
    'Content-Type': 'application/json',
    Authorization: `Bearer mockedAccessToken`
  };

  test('apiBaseUrl should return Commerce API base url', () => {
    expect(DRCommerceApi.apiBaseUrl).toEqual('https://api.digitalriver.com/v1/shoppers');
  });

  test('getCart should make $.ajax call', () => {
    DRCommerceApi.getCart({ expand: 'all' });
    expect($.ajax).toBeCalledWith({
      type: 'GET',
      headers: defaultHeaders,
      url: 'https://api.digitalriver.com/v1/shoppers/me/carts/active?expand=all',
      success: expect.any(Function),
      error: expect.any(Function)
    });
  });

  test('updateCart should make $.ajax call', () => {
    DRCommerceApi.updateCart();
    expect($.ajax).toBeCalledWith({
      type: 'POST',
      headers: defaultHeaders,
      url: 'https://api.digitalriver.com/v1/shoppers/me/carts/active?',
      data: null,
      success: expect.any(Function),
      error: expect.any(Function)
    });

    DRCommerceApi.updateCart({ expand: 'all' }, { cart: {} });
    expect($.ajax).toBeCalledWith({
      type: 'POST',
      headers: defaultHeaders,
      url: 'https://api.digitalriver.com/v1/shoppers/me/carts/active?expand=all',
      data: '{"cart":{}}',
      success: expect.any(Function),
      error: expect.any(Function)
    });
  });

  test('removeLineItem should make $.ajax call', () => {
    DRCommerceApi.removeLineItem(123456);
    expect($.ajax).toBeCalledWith({
      type: 'DELETE',
      headers: defaultHeaders,
      url: 'https://api.digitalriver.com/v1/shoppers/me/carts/active/line-items/123456',
      success: expect.any(Function),
      error: expect.any(Function)
    });
  });

  test('applyShippingOption should make $.ajax call', () => {
    DRCommerceApi.applyShippingOption (123456);
    expect($.ajax).toBeCalledWith({
      type: 'POST',
      headers: defaultHeaders,
      url: 'https://api.digitalriver.com/v1/shoppers/me/carts/active/apply-shipping-option?expand=all&shippingOptionId=123456',
      success: expect.any(Function),
      error: expect.any(Function)
    });
  });

  test('submitCart should make $.ajax call', () => {
    DRCommerceApi.submitCart({ ipAddress: '127.0.0.1' });
    expect($.ajax).toBeCalledWith({
      type: 'POST',
      headers: defaultHeaders,
      url: 'https://api.digitalriver.com/v1/shoppers/me/carts/active/submit-cart?ipAddress=127.0.0.1',
      success: expect.any(Function),
      error: expect.any(Function)
    });
  });

  test('applyPaymentMethod should make $.ajax call depends on params exist or not', () => {
    DRCommerceApi.applyPaymentMethod();
    expect($.ajax).not.toBeCalled();

    DRCommerceApi.applyPaymentMethod(123456);
    expect($.ajax).toBeCalledWith({
      type: 'POST',
      headers: defaultHeaders,
      url: 'https://api.digitalriver.com/v1/shoppers/me/carts/active/apply-payment-method?expand=all',
      data: '{"paymentMethod":{"sourceId":123456}}',
      success: expect.any(Function),
      error: expect.any(Function)
    });
  });

  test('getProduct should make $.ajax call', () => {
    DRCommerceApi.getProduct(123456, { expand: 'all' });
    expect($.ajax).toBeCalledWith({
      type: 'GET',
      headers: defaultHeaders,
      url: 'https://api.digitalriver.com/v1/shoppers/me/products/123456?expand=all',
      success: expect.any(Function),
      error: expect.any(Function)
    });
  });

  test('getProductPricing should make $.ajax call', () => {
    DRCommerceApi.getProductPricing(123456);
    expect($.ajax).toBeCalledWith({
      type: 'GET',
      headers: defaultHeaders,
      url: 'https://api.digitalriver.com/v1/shoppers/me/products/123456/pricing',
      success: expect.any(Function),
      error: expect.any(Function)
    });
  });

  test('getProductInventoryStatus should make $.ajax call', () => {
    DRCommerceApi.getProductInventoryStatus(123456);
    expect($.ajax).toBeCalledWith({
      type: 'GET',
      headers: defaultHeaders,
      url: 'https://api.digitalriver.com/v1/shoppers/me/products/123456/inventory-status',
      success: expect.any(Function),
      error: expect.any(Function)
    });
  });

});
