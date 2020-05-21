import drToast from '../../../assets/js/public/dr-toast';

describe('DR Toast', () => {

  describe('Test displayMessage', () => {
    jest.useFakeTimers();

    test('.dr-toast should be appended on the body when the method is called', () => {
      drToast.displayMessage('Message A.');
      drToast.displayMessage('Message B.');
      expect($('.dr-toast').length).toEqual(2);
    });

    test('.dr-toast should be applied CSS classes', () => {
      drToast.displayMessage('Hello World!', 'success');
      expect($('.dr-toast').hasClass('show success')).toBe(true);

      drToast.displayMessage('Hello World!', 'error');
      expect($('.dr-toast').hasClass('show error')).toBe(true);
    });

    test('.dr-toast should show up with 8s', () => {
      drToast.displayMessage('Hello World!');
      expect(setTimeout).toHaveBeenLastCalledWith(expect.any(Function), 8000);
    });
  });

});
