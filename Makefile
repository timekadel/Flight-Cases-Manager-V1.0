##############################################
#Definitions
##############################################

VERSION = DEBUG
PRODUCT =
PREFIX =

CC = $(PREFIX)g++
LD = $(PREFIX)ld
AR = $(PREFIX)ar
RANLIB = $(PREFIX)ranlib

VPATH  = ..
INCLUDE  = -I../../SkyeTekAPI
LIBS = -L../../SkyeTekAPI/unix -lstapi
CFLAGS = -g -O0 -Wall -DDEBUG 
EXE = FManager
OBJS += FManager.o

OS = $(shell uname -s)
ifeq ($(OS),Linux)
  CFLAGS += -DLINUX
  LIBS += -lusb
  LCURL += -lcurl
endif

##############################################
#Rules
##############################################

all: build_msg $(EXE) 
	@echo; echo $(VERSION) build complete; echo

stapi:
	(cd ../../SkyeTekAPI/unix; $(MAKE) -j8)

$(EXE): $(OBJS) stapi
	$(CC) -o $@ $(OBJS) $(LIBS) $(LCURL)
	@echo

%.a: %.o
	$(RANLIB) $@
	@echo

%.o: %.c
	$(CC) -c $(INCLUDE) $(CFLAGS) $(LCURL) $<
	@echo

clean:
	rm -f *.o *.elf *.lst *.s *.i *.a $(EXE)

realclean: clean
	rm -f $(EXE)
	(cd ../../SkyeTekAPI/unix; $(MAKE) clean)

build_msg:
	@echo; echo $(VERSION); echo
