# Supplied classes

## Class `StringObject`

Class that behaves much like a string, providing implicit conversion
to string, count() and `[]` operations. Useful because derived classes
can add methods to such "strings".

## Class `ReadonlyStringObject`

Like `StringObject`, but preventing any changes to the contained
string through `[]` operations.

## Class `AbstractEnum`

A derived class must define a public constant `VALUES` containing the
valid values. Objects of this class then behave like enumerators in
that they are guaranteed to contain one of the valid values.

## Class `Expander`

Simple class that replaces placeholders in text, in PSR-3 and other
formats.
